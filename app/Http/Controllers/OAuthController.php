<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function index()
    {
        return Inertia::render('OAuth');
    }

    public function redirect()
    {
        return Socialite::driver('github')
            ->scopes(['repo'])->redirect();
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

        return redirect()->route('sprints.index');
    }
}
