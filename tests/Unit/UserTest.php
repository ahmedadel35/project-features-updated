<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
use App\Models\User;

test('user have categories', function () {
    $user = User::factory()->createQuietly();

    expect($user)
        ->categories->not()
        ->toBe(null);
});

test('user have projects through categories', function () {
    $user = User::factory()
        ->has(Category::factory()->has(Project::factory()->count(5)))
        ->createQuietly();

    expect($user)->projects->toHaveCount(5);
});

test('user have todos through categories, projects', function () {
    $user = User::factory()
        ->has(Category::factory()->has(Project::factory()->has(Todo::factory()->count(6))))
        ->createQuietly();

    expect($user)->todos->toHaveCount(6);
});

test('user have hashed id', function() {
    $user = User::factory()->create();

    expect($user->id_hash)->toBe(Hashids::encode($user->id));
});

test('user have default avatar', function() {
    // normal user
    $user = User::factory()->create();
    expect($user->avatar)->not()->toBe(url('/users/admin.jpeg'));

    // user without avatar
    $user = User::factory()->create([
        'avatar' => null,
    ]);
    expect($user->avatar)->toBe(url('/users/admin.jpeg'));
});