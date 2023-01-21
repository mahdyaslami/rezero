<?php

namespace App\Http\Controllers\Scrum;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SprintController extends Controller
{
    public function index()
    {
        return Inertia::render('Scrum/Sprint/Index', [
            'sprints' => auth()->user()->sprints()
                ->orderByDesc('number')->get()
        ]);
    }

    public function store()
    {
        auth()->user()->sprints()->create([
            'number' => auth()->user()->sprints()->count() + 1,
            'start_date' => now(),
            'finish_date' => now()->addWeek()
        ]);

        return redirect()->back();
    }

    public function edit()
    {
        $oauth = false;
        $repos = [['id' => 0, 'name' => 'No Select']];

        if (!!auth()->user()->github) {
            $oauth = true;
            $repos = $this->repos();
        }

        return Inertia::render('Scrum/Sprint/Edit', compact('oauth', 'repos'));
    }

    private function repos()
    {
        $client = app('github.api');
        $client->authenticate(
            auth()->user()->github->token,
            \Github\AuthMethod::ACCESS_TOKEN
        );

        $result = Cache::remember(
            auth()->user()->github->username . ':repos',
            300,
            fn () => $client->api('me')->repositories()
        );
        $result = collect($result);
        return $result->map(fn ($r) =>  Arr::only($r, ['id', 'name']));
    }
}
