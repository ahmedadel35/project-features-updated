<?php

use App\Models\Category;
use App\Models\Project;

test('category has slug', function () {
    $title = $this->faker->sentence;

    $cat = Category::factory()->create(compact('title'));

    expect($cat->slug)->toBe(Str::slug($title));
});

test('category has projects', function () {
    $cat = Category::factory()
        ->has(Project::factory()->count(2))
        ->create();

    expect($cat->projects)->toHaveCount(2);
});
