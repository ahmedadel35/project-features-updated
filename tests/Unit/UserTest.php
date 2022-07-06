<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\User;

test('user have categories', function () {
    $user = User::factory()->create();

    expect($user)
        ->categories->not()
        ->toBe(null);
});

test('user have projects through categories', function () {
    $user = User::factory()
        ->has(Category::factory()->has(Project::factory()->count(5)))
        ->create();

    expect($user)->projects->toHaveCount(5);
});
