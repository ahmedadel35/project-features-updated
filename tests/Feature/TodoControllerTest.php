<?php

use App\Models\Todo;
use App\Models\User;

test('any one can not add new todo', function () {
    [$user, $cat, $proj] = userWithTodos();

    actingAs()
        ->post(route('tasks.store', [$cat->slug, $proj->slug]), [])
        ->assertForbidden();
});

test('project owner can not add task with invalid data', function () {
    [$user, $cat, $proj] = userWithTodos();

    actingAs($user)
        ->postJson(route('tasks.store', [$cat->slug, $proj->slug]), [])
        ->assertStatus(422);
});

test('project owner can add task', function () {
    [$user, $cat, $proj] = userWithTodos();

    $task = Todo::factory()->raw();

    actingAs($user)
        ->postJson(route('tasks.store', [$cat->slug, $proj->slug]), $task)
        ->assertCreated()
        ->assertSee($task['body']);

    expect(Todo::whereBody($task['body'])->exists())->toBeTrue();
});

test('invited user can add task', function () {
    [$user, $cat, $proj] = userWithTodos();
    $invited = User::factory()->create();

    $proj->addToTeam($invited);

    $task = Todo::factory()->raw();

    actingAs($invited)
        ->postJson(route('tasks.store', [$cat->slug, $proj->slug]), $task)
        ->assertCreated()
        ->assertSee($task['body']);

    expect(Todo::whereBody($task['body'])->exists())->toBeTrue();
});

test('user can not update task with invalid data', function () {
    [$user, $cat, $proj, $task] = userWithTodos();

    actingAs($user)
        ->putJson(route('tasks.update', [$cat->slug, $proj->slug, $task->id]), [
            'body' => '',
        ])
        ->assertStatus(422);

    expect(Todo::find($task->id))->body->toBe($task->body);
});

test('project owner can update task', function () {
    [$user, $cat, $proj, $task] = userWithTodos();

    $body = fake()->sentence;

    actingAs($user)
        ->putJson(
            route('tasks.update', [$cat->slug, $proj->slug, $task->id]),
            compact('body')
        )
        ->assertNoContent();

    expect(Todo::find($task->id))->body->toBe($body);
});

test('project team user can update task', function () {
    [, $cat, $proj, $task] = userWithTodos();
    $ali = User::factory()->create();
    $body = fake()->sentence;

    actingAs($ali)
        ->putJson(
            route('tasks.update', [$cat->slug, $proj->slug, $task->id]),
            compact('body')
        )
        ->assertForbidden();
    expect(Todo::find($task->id))->body->toBe($task->body);

    $proj->addToTeam($ali);

    actingAs($ali)
        ->putJson(
            route('tasks.update', [$cat->slug, $proj->slug, $task->id]),
            compact('body')
        )
        ->assertNoContent();

    expect(Todo::find($task->id))->body->toBe($body);
});

test('project owner can delete task', function () {
    [$user, $cat, $proj, $task] = userWithTodos();

    expect(Todo::find($task->id)->exists())->toBeTrue();

    actingAs($user)
        ->delete(route('tasks.destroy', [$cat->slug, $proj->slug, $task->id]))
        ->assertNoContent();

    expect(Todo::find($task->id)?->exists())->toBeNull();
    $this->assertDatabaseMissing('todos', ['id' => $task->id]);
});

test('project team user can delete task', function () {
    [, $cat, $proj, $task] = userWithTodos();
    $ali = User::factory()->create();

    expect(Todo::find($task->id)->exists())->toBeTrue();

    actingAs($ali)
        ->delete(route('tasks.destroy', [$cat->slug, $proj->slug, $task->id]))
        ->assertForbidden();
    expect(Todo::find($task->id)->exists())->toBeTrue();

    $proj->addToTeam($ali);

    actingAs($ali)
        ->delete(route('tasks.destroy', [$cat->slug, $proj->slug, $task->id]))
        ->assertNoContent();

    expect(Todo::find($task->id)?->exists())->toBeNull();
    $this->assertDatabaseMissing('todos', ['id' => $task->id]);
});

test('project owner can get list of tasks', function () {
    [$user, $cat, $proj, $task] = userWithTodos(tasks_count: 10);

    actingAs($user)
        ->get(route('tasks.index', [$cat->slug, $proj]))
        ->assertOk()
        ->assertViewIs('task.index');
});

test('project team user can get list of tasks', function () {
    [, $cat, $proj, $task] = userWithTodos(tasks_count: 10);
    $ali = User::factory()->create();

    // try with any user
    actingAs($ali)
        ->get(route('tasks.index', [$cat->slug, $proj]))
        ->assertForbidden();

    $proj->addToTeam($ali);

    actingAs($ali)
        ->get(route('tasks.index', [$cat->slug, $proj]))
        ->assertOk()
        ->assertViewIs('task.index');
});

test('only project owner can complete task', function () {
    [$user, $cat, $proj, $task] = userWithTodos();
    $task->updateQuietly(['completed' => false]);
    expect(Todo::find($task->id)->completed)->toBeFalse();

    actingAs($user)
        ->putJson(route('tasks.toggle', [$cat->slug, $proj->slug, $task->id]), [
            'completed' => true,
        ])
        ->assertOk();

    expect(Todo::find($task->id)->completed)->toBeTrue();
});

test('user invited to project can complete task', function () {
    [, $cat, $proj, $task] = userWithTodos();
    $ali = User::factory()->create();

    $task->updateQuietly(['completed' => false]);
    expect(Todo::find($task->id)->completed)->toBeFalse();

    actingAs($ali)
        ->putJson(route('tasks.toggle', [$cat->slug, $proj->slug, $task->id]), [
            'completed' => true,
        ])
        ->assertForbidden();
    expect(Todo::find($task->id)->completed)->toBeFalse();

    $proj->addToTeam($ali);

    actingAs($ali)
        ->putJson(route('tasks.toggle', [$cat->slug, $proj->slug, $task->id]), [
            'completed' => true,
        ])
        ->assertOk();

    expect(Todo::find($task->id)->completed)->toBeTrue();
});

test('completing all tasks will turn project state to completed', function () {
    /** @var \App\Models\Project $proj */
    [$user, $cat, $proj, $tasks] = userWithTodos(tasks_count: 2);
    $tasks->each->updateQuietly(['completed' => false]);
    expect(Todo::find($tasks->first()->id)->completed)->toBeFalse();

    actingAs($user)
        ->putJson(
            route('tasks.toggle', [
                $cat->slug,
                $proj->slug,
                $tasks->first()->id,
            ]),
            [
                'completed' => true,
            ]
        )
        ->assertOk();

    $proj->refresh();
    expect($proj->completed)->toBeFalse();

    actingAs($user)
        ->putJson(
            route('tasks.toggle', [
                $cat->slug,
                $proj->slug,
                $tasks->last()->id,
            ]),
            [
                'completed' => true,
            ]
        )
        ->assertOk();

    $proj->refresh();
    expect($proj->completed)->toBeTrue();
});

test('un checking task will remove project completed state', function () {
    /** @var \App\Models\Project $proj */
    [$user, $cat, $proj, $task] = userWithTodos(
        projectAttrs: ['completed' => true]
    );

    expect($proj->completed)->toBeTrue();

    // un check task
    actingAs($user)
        ->putJson(route('tasks.toggle', [$cat->slug, $proj->slug, $task->id]), [
            'completed' => false,
        ])
        ->assertOk();

    $proj->refresh();

    expect($proj->completed)->toBeFalse();
});

test(
    'creating a task into completed project will remove completed',
    function () {
        /** @var \App\Models\Project $proj */
        [$user, $cat, $proj, $task] = userWithTodos(
            projectAttrs: ['completed' => true]
        );

        actingAs($user)
            ->post(
                route('tasks.store', [$cat->slug, $proj->slug]),
                Todo::factory()->raw()
            )
            ->assertCreated();

        $proj->refresh();
        expect($proj->completed)->toBeFalse();
    }
);
