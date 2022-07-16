<?php

namespace App\Http\Controllers\ExternalLogin;

class GoogleLoginController extends AbstractExternalLoginController
{
    protected function getServiceSlug(): string
    {
        return 'google';
    }    
}
