<?php

namespace App\Http\Controllers\Scrum;

use App\Facades\Github;
use App\Http\Controllers\Controller;
use App\Http\Requests\RepositoryRequest;
use Inertia\Inertia;

class RepositoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Scrum/Repository/Index', [
            'repos' => Github::repositories(),
            'selected' => auth()->user()->repositories()->pluck('id'),
        ]);
    }

    public function store(RepositoryRequest $request)
    {
        $relation = auth()->user()->repositories();

        $relation->delete();

        $relation->createMany($request->repos);

        return back();
    }
}
