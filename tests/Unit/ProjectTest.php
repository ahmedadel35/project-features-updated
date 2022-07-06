<?php

use App\Models\Project;
use App\Models\Todo;

test('project belongs to category', function () {
    $p = Project::factory()->create();

    expect($p->category)
        ->not->toBeNull()
        ->slug->not->toBeNull();
});

test('project have todos', function () {
    $p = Project::factory()
        ->has(Todo::factory()->count(5))
        ->create();

    expect($p->todos)
        ->toHaveCount(5)
        ->first()->body->toBeString();
});
