<?php

namespace App\Http\Controllers\Scrum;

use App\Facades\Github;
use App\Http\Controllers\Controller;
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
            $repos = Github::repositories();
        }

        return Inertia::render('Scrum/Sprint/Edit', compact('oauth', 'repos'));
    }
}
