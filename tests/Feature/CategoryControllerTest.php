<?php

use App\Models\Category;
use App\Models\User;

test('unloggedin user can not see categories', function () {
    get(route('categories.index'))->assertRedirect(route('login'));
});

test('user can see only his categories', function () {
    [$user, $cat] = userWithTodos();

    actingAs()
        ->get(route('categories.index'))
        ->assertDontSee($cat->title);

    actingAs($user)
        ->get(route('categories.index'))
        ->assertSee($cat->title);
});

test('user can not create category with invalid data', function () {
    actingAs()
        ->postJson(route('categories.store'), [])
        ->assertStatus(422);
});

test('user can create category', function () {
    $user = User::factory()->create();

    $cat = Category::factory()->raw();

    actingAs($user)
        ->postJson(route('categories.store', $cat))
        ->assertCreated();
});

test('user can update only his category', function () {
    [$user, $cat] = userWithTodos();

    $title = fake()->sentence;
    $description = fake()->paragraph;

    // try with another user
    actingAs()
        ->putJson(
            route('categories.update', $cat->slug),
            compact('title', 'description')
        )
        ->assertForbidden();
    expect(Category::whereTitle($title)->first())->toBeNull();

    // try with owner user
    actingAs($user)
        ->putJson(
            route('categories.update', $cat->slug),
            compact('title', 'description')
        )
        ->assertNoContent();

    expect(Category::whereSlug($cat->slug)->first())->title->toBe($title);
});

test('user can delete only owned category', function () {
    [$user, $cat] = userWithTodos();

    // try with another user
    actingAs()
        ->deleteJson(route('categories.destroy', $cat->slug))
        ->assertForbidden();
    expect(Category::whereSlug($cat->slug)->count())->toBe(1);

    // try with owner user
    actingAs($user)
        ->deleteJson(route('categories.destroy', $cat->slug))
        ->assertRedirect();

    expect(Category::count())->toBe(0);
});
