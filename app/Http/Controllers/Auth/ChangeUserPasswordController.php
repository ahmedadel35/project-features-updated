<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class ChangeUserPasswordController extends Controller
{
    public function create()
    {
        SEOTools::setTitle(__('auth.change_password'));

        return view('auth.change_password');
    }

    public function update(Request $request)
    {
        $req = $request->validate([
            'old-password' => ['sometimes', Rules\Password::defaults()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();

        // check if user joined with third party apps
        if ($user->changed_password) {
            abort_if(! isset($req['old-password']), 403);
            // verify old password
            if (! Hash::check($req['old-password'], $user->password)) {
                return back()->withErrors(['old-password' => __('auth.Password')]);
            }
        }

        $user->update([
            'password' => Hash::make($req['password']),
            'changed_password' => true,
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
