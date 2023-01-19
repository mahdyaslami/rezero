<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('github')->user();

        auth()->user()->github()->updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'username' => $user->user['login'],
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn
            ]
        );

        return redirect()->route('dashboard');
    }
}
