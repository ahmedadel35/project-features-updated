<?php

use App\Models\Todo;

test('any one can not add new todo', function () {
    [$user, $cat, $proj] = userWithTodos();

    actingAs()
        ->post(route('tasks.store', [$cat->slug, $proj->slug]), [])
        ->assertForbidden();
});

test('project owner can not add todo with invalid data', function () {
    [$user, $cat, $proj] = userWithTodos();

    actingAs($user)
        ->postJson(route('tasks.store', [$cat->slug, $proj->slug]), [])
        ->assertStatus(422);
});

test('project owner can add todo', function () {
    [$user, $cat, $proj] = userWithTodos();

    $task = Todo::factory()->raw();

    actingAs($user)
        ->postJson(route('tasks.store', [$cat->slug, $proj->slug]), $task)
        ->assertCreated()
        ->assertJson(['body' => $task['body']]);

    expect(Todo::whereBody($task['body'])->exists())->toBeTrue();
});