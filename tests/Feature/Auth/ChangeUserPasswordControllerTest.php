<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('guest can not change password', function () {
    $this->get(route('change-password.create'))->assertRedirect(route('login'));
});

it('has change password page', function () {
    $response = actingAs()->get(route('change-password.create'));

    $response->assertStatus(200)->assertSee('new-password');
});

it('will show old password if user changed password before', function () {
    $user = User::factory()->create([
        'changed_password' => false,
    ]);

    actingAs($user)
        ->get(route('change-password.create'))
        ->assertDontSee('old-password')
        ->assertSee('password');

    $user->update(['changed_password' => true]);

    actingAs($user)
        ->get(route('change-password.create'))
        ->assertSee('old-password')
        ->assertSee('password');
});

test('user can not change password with invalid data', function () {
    $user = User::factory()->create([
        'changed_password' => false,
    ]);

    // without old-password
    $res = actingAs($user)
        ->put(route('change-password.update'), [])
        ->assertStatus(302)
        ->assertSessionHasErrors();

    $pass = fake()->sentence(5);

    $user->changed_password = true;
    $user->update();
    // with old password
    $res = actingAs($user)
        ->put(route('change-password.update'), [
            'old-password' => fake()->text(7), // min length is 8 chars
            'password' => $pass,
            'password_confirmation' => $pass,
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors(['old-password']);

    // without old password and user must provide it
    $res = actingAs($user)
        ->put(route('change-password.update'), [
            'password' => $pass,
            'password_confirmation' => $pass,
        ])
        ->assertStatus(403);
});

test(
    'user can change password for the first time without old one',
    function () {
        $user = User::factory()->create([
            'changed_password' => false,
        ]);
        $another = User::factory()->create();

        $pass = fake()->sentence(5);

        actingAs($user)
            ->put(route('change-password.update'), [
                'password' => $pass,
                'password_confirmation' => $pass,
            ])
            ->assertRedirect(RouteServiceProvider::HOME);

        expect(User::latest('updated_at')->first())->id->toBe($user->id);
        expect(Auth::user())->toBe($user);
    }
);

test('user can change password with old one if changed before', function () {
    $oldPass = fake()->sentence(5);
    $pass = fake()->sentence(6);
    $user = User::factory()->create([
        'changed_password' => true,
        'password' => Hash::make($oldPass),
    ]);
    $this->travel(10)->second();
    $another = User::factory()->create();

    // try with invalid old password
    actingAs($user)
        ->put(route('change-password.update'), [
            'old-password' => fake()->sentence(5),
            'password' => $pass,
            'password_confirmation' => $pass,
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors(['old-password']);

    expect(User::latest('updated_at')->first())->id->toBe($another->id);

    actingAs($user)
        ->put(route('change-password.update'), [
            'old-password' => $oldPass,
            'password' => $pass,
            'password_confirmation' => $pass,
        ])
        ->assertRedirect(RouteServiceProvider::HOME);

    expect(User::latest('updated_at')->first())->id->toBe($user->id);
    expect(Auth::user())->toBe($user);

    // try to login user with new password
    Auth::guard('web')->logout();

    $this->post(route('login'), [
        'email' => $user->email,
        'password' => $pass,
    ])
        ->assertStatus(302)
        ->assertSessionHasNoErrors();
});
