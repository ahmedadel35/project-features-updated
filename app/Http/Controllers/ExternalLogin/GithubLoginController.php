<?php

namespace App\Http\Controllers\ExternalLogin;

class GithubLoginController extends AbstractExternalLoginController
{
    protected function getServiceSlug(): string
    {
        return 'github';
    }
}
