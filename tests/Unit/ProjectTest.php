<?php

use App\Models\Project;
use App\Models\Todo;
use App\Models\User;

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

test('project have team', function() {
    $p = Project::factory()->create();

    expect($p->team)->toHaveCount(0);
});

test('project can add users to team', function() {
    $p = Project::factory()->create();

    expect($p->team)->toHaveCount(0);

    $p->addToTeam(User::factory()->create());

    $p->refresh();
    expect($p->team)->toHaveCount(1);
});

test('project can check if user is team member', function() {
    $p = Project::factory()->create();
    $user = User::factory()->create();

    expect($p->isTeamMember($user))->toBeFalse();

    $p->addToTeam($user);

    $p->refresh();
    expect($p->isTeamMember($user))->toBeTrue();
});