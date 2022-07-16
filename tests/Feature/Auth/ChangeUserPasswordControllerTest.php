<?php

use App\Models\User;

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
        ->assertDontSee('old password')
        ->assertSee('new-password');

    $user->update(['changed_password' => true]);

    actingAs($user)
        ->get(route('change-password.create'))
        ->assertSee('old-password')
        ->assertSee('new-password');
});

test('user can not change password with invalid data', function () {
    $user = User::factory()->create();

    // without old-password
    $res = actingAs($user)
        ->put(route('change-password.update'), [])
        ->assertStatus(302)
        ->assertSessionHasErrors();

    // with old password
    $res = actingAs($user)
        ->put(route('change-password.update'), [
            'password' => fake()->text(7), // min length is 8 chars
            'new-password' => fake()->password,
            'password_confirmation' => fake()->password,
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors();
});
