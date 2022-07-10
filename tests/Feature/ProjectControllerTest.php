<?php

use App\Models\Project;
use App\Models\User;

use function Pest\Laravel\withoutExceptionHandling;

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
    expect(Project::whereName($proj['name'])->exists())->toBeFalse();

    // try with the owner
    actingAs($user)
        ->postJson(route('projects.store', $cat->slug), $proj)
        ->assertRedirect();

    expect(Project::whereName($proj['name'])->exists())->toBeTrue();
});

test('only category owner can update projects in it', function () {
    [$user, $cat, $proj] = userWithTodos();

    $name = fake()->sentence;
    $cost = fake()->randomFloat(2, 1, 999999);

    // try with any user
    actingAs()
        ->putJson(
            route(
                'projects.update',
                array_merge([$cat->slug, $proj->slug], $proj->toArray())
            ),
            compact('name', 'cost')
        )
        ->assertForbidden();

    expect(
        Project::whereName($name)
            ->whereSlug($proj->slug)
            ->exists()
    )->toBeFalse();

    // try with the owner
    actingAs($user)
        ->putJson(
            route(
                'projects.update',
                array_merge([$cat->slug, $proj->slug], $proj->toArray())
            ),
            compact('name', 'cost')
        )
        ->assertRedirect(route('projects.show', [$cat->slug, $proj->slug]));

    expect(
        Project::whereName($name)
            ->whereSlug($proj->slug)
            ->exists()
    )->toBeTrue();
});

test('only project owner can delete it', function () {
    [$user, $cat, $proj] = userWithTodos();
    // try with any user
    actingAs()
        ->deleteJson(route('projects.destroy', [$cat->slug, $proj->slug]))
        ->assertForbidden();

    expect(Project::whereSlug($proj->slug)->exists())->toBeTrue();

    // try with the owner
    actingAs($user)
        ->deleteJson(route('projects.destroy', [$cat->slug, $proj->slug]))
        ->assertNoContent();

    expect(Project::whereSlug($proj->slug)->exists())->toBeFalse();
});

test('only category owner can create projects for it', function () {
    [$user, $cat] = userWithTodos();
    // try with any user
    actingAs()
        ->get(route('projects.create', $cat->slug))
        ->assertForbidden();

    // try with the owner
    actingAs($user)
        ->get(route('projects.create', $cat->slug))
        ->assertOk()
        ->assertSee(__('nav.create_project'));
});

test('only category owner can edit project', function () {
    [$user, $cat, $proj] = userWithTodos();
    // try with any user
    actingAs()
        ->get(route('projects.edit', [$cat->slug, $proj->slug]))
        ->assertForbidden();

    // try with the owner
    actingAs($user)
        ->get(route('projects.edit', [$cat->slug, $proj->slug]))
        ->assertOk()
        ->assertSee(__('nav.edit_project'));
});

test('only project owner can invite users to team', function () {
    [$user, $cat, $proj] = userWithTodos();
    $teamUser = User::factory()->create();

    // try with any user
    actingAs()
        ->post(route('projects.invite', [$cat->slug, $proj->slug]), [
            'email' => $teamUser->email,
        ])
        ->assertForbidden();

    // try with owner
    actingAs($user)
        ->post(route('projects.invite', [$cat->slug, $proj->slug]), [
            'email' => $teamUser->email,
        ])
        ->assertOk()
        ->assertSee($teamUser->avatar);
});
