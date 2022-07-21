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

test('project owner can not invite un registered user', function () {
    [$user, $cat, $proj] = userWithTodos();
    // try with owner
    actingAs($user)
        ->postJson(route('projects.invite', [$cat->slug, $proj->slug]), [
            'email' => fake()->email,
        ])
        ->assertStatus(422);
});

test('project owner can not invite user twice', function () {
    [$user, $cat, $proj] = userWithTodos();
    $teamUser = User::factory()->create();

    actingAs($user)
        ->post(route('projects.invite', [$cat->slug, $proj->slug]), [
            'email' => $teamUser->email,
        ])
        ->assertOk()
        ->assertSee($teamUser->avatar);

    actingAs($user)
        ->post(route('projects.invite', [$cat->slug, $proj->slug]), [
            'email' => $teamUser->email,
        ])
        ->assertStatus(422);
});

test('user can see only completed projects', function () {
    [$user, $cat, $proj] = userWithTodos(projects_count: 5);
    $proj->first()->update(['completed' => true]);

    // create non completed project
    $nonCompleted = Project::factory()->create([
        'category_id' => $cat->id,
        'completed' => false,
    ]);

    $url = route('categories.show', $cat->slug);

    actingAs($user)
        ->get($url . '?filter[completed]=true')
        ->assertOk()
        ->assertSee($proj->first()->slug)
        ->assertDontSee($nonCompleted->slug);

    actingAs($user)
        ->get($url . '?filter[completed]=false')
        ->assertOk()
        ->assertDontSee($proj->first()->slug)
        ->assertSee($nonCompleted->slug);
});

test('user invited to project can see it', function () {
    [$user, $cat, $proj] = userWithTodos();
    $ali = User::factory()->create();

    expect($proj->isTeamMember($ali))->toBeFalse();
    // try before inviting like anyone
    // then should fail
    actingAs($ali)
        ->get(route('projects.show', [$cat, $proj]))
        ->assertForbidden();

    // invite user
    $proj->addToTeam($ali);

    $proj->refresh();
    expect($proj->isTeamMember($ali))->toBeTrue();

    // should work
    actingAs($ali)
        ->get(route('projects.show', [$cat, $proj]))
        ->assertOk();
});

test('project owner can see all projects', function () {
    [$user, $cat, $proj] = userWithTodos(projects_count: 5);

    actingAs($user)
        ->get(route('projects.index', ['project_tab' => 'all']))
        ->assertOk()
        ->assertSee($proj->first()->title);
});

test('user refuse invitation to project', function () {
    /** @var App\Models\Project $proj */
    [, $cat, $proj] = userWithTodos();
    $user = User::factory()->create();
    expect($proj->isTeamMember($user))->toBeFalse();

    // invite user to project
    $proj->addToTeam($user);
    expect($proj->isTeamMember($user))->toBeTrue();

    // refuse invitaion
    actingAs($user)
        ->deleteJson(route('projects.refuse', [$cat, $proj]))
        ->assertStatus(204);

    $proj->refresh();
    expect($proj->isTeamMember($user))->toBeFalse();
});

test('project owner can remove user from project team', function () {
    /** @var App\Models\Project $proj */
    [$owner, $cat, $proj] = userWithTodos();
    $this->travel(1)->seconds();
    $user = User::factory()->create();
    expect($proj->isTeamMember($user))->toBeFalse();

    // invite user to project
    $proj->addToTeam($user);
    expect($proj->isTeamMember($user))->toBeTrue();

    // remove from team
    actingAs($owner)
        ->deleteJson(route('projects.refuse', [$cat, $proj, $user->id_hash]))
        ->assertNoContent();

    $proj->refresh();
    expect($proj->isTeamMember($user))->toBeFalse();
});
