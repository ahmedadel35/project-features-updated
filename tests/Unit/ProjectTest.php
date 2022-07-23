<?php

use App\Models\Project;
use App\Models\Todo;
use App\Models\User;

test('project belongs to category', function () {
    $p = Project::factory()->createQuietly();

    expect($p->category)
        ->not->toBeNull()
        ->slug->not->toBeNull();
});

test('project have todos', function () {
    $p = Project::factory()
        ->has(Todo::factory()->count(5))
        ->createQuietly();

    expect($p->todos)
        ->toHaveCount(5)
        ->first()
        ->body->toBeString();
});

test('project have team', function () {
    $p = Project::factory()->createQuietly();

    expect($p->team)->toHaveCount(0);
});

test('project can add users to team', function () {
    $p = Project::factory()->createQuietly();

    expect($p->team)->toHaveCount(0);

    $p->addToTeam(User::factory()->createQuietly());

    $p->refresh();
    expect($p->team)->toHaveCount(1);
});

test('project can check if user is team member', function () {
    $p = Project::factory()->createQuietly();
    $user = User::factory()->createQuietly();

    expect($p->isTeamMember($user))->toBeFalse();

    $p->addToTeam($user);

    $p->refresh();
    expect($p->isTeamMember($user))->toBeTrue();
});

test('project have owner', function () {
    [$user, , $proj] = userWithTodos();

    expect($proj->owner->email)->toBe($user->email);
});

test('project owner can not be added to team', function () {
    /** @var \App\Models\Project */
    $p = Project::factory()->createQuietly();

    expect($p->team)->toHaveCount(0);

    $p->addToTeam($p->owner);

    // still have no team
    $p->refresh();
    expect($p->team)->toHaveCount(0);
    expect($p->isTeamMember($p->owner))->toBeFalse();
});

test('project can not dublicate team members', function () {
    /** @var \App\Models\Project */
    $p = Project::factory()->createQuietly();
    $user = User::factory()->createQuietly();

    $p->refresh();
    expect($p->team)->toHaveCount(0);

    $p->addToTeam($user);
    $p->refresh();
    expect($p->team)->toHaveCount(1);
    expect($p->isTeamMember($user))->toBeTrue();

    $p->addToTeam($user);
    $p->refresh();
    expect($p->team)->toHaveCount(1);
    expect($p->isTeamMember($user))->toBeTrue();
});

test('project can remove user from team', function () {
    $p = Project::factory()->createQuietly();
    $user = User::factory()->createQuietly();
    expect($p->isTeamMember($user))->toBeFalse();
    $p->addToTeam($user);
    $p->refresh();
    expect($p->isTeamMember($user))->toBeTrue();

    // remove user from project team
    $p->removeFromTeam($user);

    expect($p->isTeamMember($user))->toBeFalse();
});
