<?php

use App\Models\Project;
use App\Models\User;

test('only logged in users can create projects', function () {
    [$user, $cat, $proj] = userWithTodos();

    $this->post(route('projects.store', $cat->slug), [])->assertRedirect();
});

test('only category owner can create projects', function () {
    [$user, $cat] = userWithTodos();

    $proj = Project::factory()->raw();

    // try with any user
    actingAs()
        ->postJson(route('projects.store', $cat->slug), $proj)
        ->assertForbidden();

    // try with the owner
    actingAs($user)
        ->postJson(route('projects.store', $cat->slug), $proj)
        ->assertRedirect();
});
