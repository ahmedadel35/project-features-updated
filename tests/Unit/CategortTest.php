<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\User;

test('category has slug', function () {
    $title = $this->faker->sentence;

    $cat = Category::factory()->create(compact('title'));

    expect($cat->slug)->not->toBeNull();
});

test('category has projects', function () {
    $cat = Category::factory()
        ->has(Project::factory()->count(2))
        ->create();

    expect($cat->projects)->toHaveCount(2);
});

test('category belongs to user', function() {
    $user_id = User::factory()->create()->id;
    $cat = Category::factory()->create(compact('user_id'));

    expect($cat->user->id)->toBe($user_id);
});