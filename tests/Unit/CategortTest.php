<?php

use App\Models\Category;

test('category has slug', function () {
    $title = $this->faker->sentence;

    $cat = Category::factory()->create(compact('title'));

    expect($cat->slug)->toBe(Str::slug($title));
});
