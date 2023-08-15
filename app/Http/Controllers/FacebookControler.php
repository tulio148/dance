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

        $user = User::updateOrCreate([
            'facebook_id' => $fbUser->id,
        ], [
            'name' => $fbUser->name,
            'email' => $fbUser->email,
            'avatar' => $fbUser->avatar,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
