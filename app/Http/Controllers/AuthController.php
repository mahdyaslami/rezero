<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return \Redirect::to('/');
    }
}
