<?php

namespace App\Http\Controllers\Scrum;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepositoryRequest;
use App\Models\Repository;
use Illuminate\Support\Facades\Gate;

class RepositoryController extends Controller
{
    public function store(RepositoryRequest $request)
    {
        $relation = auth()->user()->repositories();

        $relation->delete();

        $relation->createMany($request->repos);

        return back();
    }

    public function destroy(Repository $repository)
    {
        Gate::authorize('repository-delete', $repository);

        $repository->delete();

        return back();
    }
}