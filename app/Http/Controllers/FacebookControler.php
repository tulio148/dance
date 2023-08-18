<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class FacebookControler extends Controller
{

    public function redirectToFacebook()

    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();
        // dd($fbUser);

        $user = User::updateOrCreate(
            ['email' => $fbUser->getEmail()],
            [
                'name' => $fbUser->getName(),
                'email' => $fbUser->getEmail(),
                'avatar' => $fbUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
