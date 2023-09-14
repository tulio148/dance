<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class FacebookControler extends Controller
{

    public function redirectToFacebook()

    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->stateless()->user();
        // dd($fbUser);

        $user = User::updateOrCreate(
            ['email' => $fbUser->getEmail()],
            [
                'name' => $fbUser->getName(),
                'email' => $fbUser->getEmail(),
            ]
        );

        $profilePictureUrl = $fbUser->avatar;
        $imageContents = file_get_contents($profilePictureUrl);
        $imageName = $user->id . '.jpg';
        Storage::disk('public')->put($imageName, $imageContents);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
