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

    public function update(Request $request)
    {
        $req = $request->validate([
            'password' => 'sometimes|string|min:8|max:255',
            'new-password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|string|min:8|max:255',
        ]);
    }
}
