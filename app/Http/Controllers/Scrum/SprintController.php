<?php

namespace App\Http\Controllers\Scrum;

use Facades\App\Github;
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
        return Inertia::render('Scrum/Sprint/Edit', [
            'repos' => Github::repositories(),
            'selectedRepos' => auth()->user()->repositories()->pluck('id'),
        ]);
    }
}
