<?php

use App\Models\User;

test('unloggedin user can not see categories', function() {

})->skip();

test('user can see only his categories', function() {
    [$user, $cat] = userWithTodos();

    actingAs()->get(route('categories.index'))->assertDontSee($cat->title);

    actingAs($user)->get(route('categories.index'))->assertSee($cat->title);
});