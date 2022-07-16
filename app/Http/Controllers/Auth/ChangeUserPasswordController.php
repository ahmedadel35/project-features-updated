<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ChangeUserPasswordController extends Controller
{
    public function create()
    {
        SEOTools::setTitle(__('auth.change_pass'));

        return view('auth.change_password');
    }
}
