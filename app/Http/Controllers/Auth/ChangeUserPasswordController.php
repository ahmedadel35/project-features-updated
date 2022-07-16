<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class ChangeUserPasswordController extends Controller
{
    public function create()
    {
        SEOTools::setTitle(__('auth.change_pass'));

        return view('auth.change_password');
    }

    public function update(Request $request)
    {
        $req = $request->validate([
            'old-password' => ['sometimes', Rules\Password::defaults()],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        // check if user joined with third party apps
        if (Auth::user()->changed_password) {
            abort_if(!isset($req['old-password']), 403);
        }
    }
}
