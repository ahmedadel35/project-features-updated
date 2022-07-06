<?php

use App\Models\User;

test('user has categories', function () {
    $user = User::factory()->create();

    expect($user)
        ->categories->not()
        ->toBe(null);
});
