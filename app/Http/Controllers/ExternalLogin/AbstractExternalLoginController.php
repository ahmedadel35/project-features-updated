<?php

namespace App\Http\Controllers\ExternalLogin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Socialite;

abstract class AbstractExternalLoginController extends Controller
{
    abstract protected function getServiceSlug(): string;

    /**
     * Redirect to obtain user access tokens.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver($this->getServiceSlug())->redirect();
    }

    /**
     * callback to service provide to fetch user profile details
     *
     * @return void
     */
    public function callback()
    {
        $user = Socialite::driver($this->getServiceSlug())
            ->stateless()
            ->user();

        $finduser = User::where('email', $user->getEmail())->first();

        if ($finduser) {
            $finduser->update([
                'avatar' => $finduser->avatar ?? $user->getAvatar(),
                'email_verified_at' => Carbon::now(),
            ]);

            Auth::login($finduser, true);

            return redirect()->route('projects.index', 'all');
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(Str::random(8)),
                'changed_password' => false,
                // you can change auto generate password here and send it via email but you need to add checking that the user need to change the password for security reasons
            ]);

            Auth::login($newUser);

            session()->flash(
                'notify',
                __('auth.change_pass_notify')
            );

            return redirect()->route('projects.index', 'all');
        }
    }
}
