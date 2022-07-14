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
