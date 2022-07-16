<?php

namespace App\Http\Controllers\ExternalLogin;

class FacebookLoginController extends AbstractExternalLoginController
{
    protected function getServiceSlug(): string
    {
        return 'facebook';
    }    
}
