<?php

test('guest can not change password', function() {
    $this->get(route('change-password.create'))->assertRedirect(route('login'));
});

it('has change password page', function () {
    $response = actingAs()->get(route('change-password.create'));

    $response->assertStatus(200)->assertSee('new-password');
});
