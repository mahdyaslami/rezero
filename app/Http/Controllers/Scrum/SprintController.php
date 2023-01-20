<?php

namespace App\Http\Controllers\Scrum;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SprintController extends Controller
{
    public function create()
    {
        if (!auth()->user()->github) {
            abort(403, 'ابتدا باید در به github خود دسترسی بدهید.');
        }

        $repos = $this->repos();

        return Inertia::render('Scrum/Sprint/Create', compact('repos'));
    }

    private function repos()
    {
        $client = app('github.api');
        $client->authenticate(
            auth()->user()->github->token,
            \Github\AuthMethod::ACCESS_TOKEN
        );

        $result = Cache::remember(
            auth()->user()->github->username.':repos',
            300,
            fn () => $client->api('me')->repositories()
        );
        $result = collect($result);
        return $result->map(fn($r) =>  Arr::only($r, ['id', 'name']));
    }
}
