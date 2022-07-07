<?php

use App\Models\Category;
use App\Models\User;

use function Pest\Laravel\get;

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

test('user can not create category with invalid data', function() {
    actingAs()->postJson(route('categories.store'), [])->assertStatus(422);
});

test('user can create category', function () {
    $user = User::factory()->create();

    $cat = Category::factory()->raw();

    actingAs($user)
        ->postJson(route('categories.store', $cat))
        ->assertCreated();
});
