<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function index()
    {
        return Inertia::render('Note/Show', [
            'notes' => auth()->user()->notes,
        ]);
    }

    public function store(NoteRequest $request)
    {
        auth()->user()->notes()->create($request->validated());
    }
}
