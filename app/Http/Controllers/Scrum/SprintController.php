<?php

namespace App\Http\Controllers\Scrum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SprintController extends Controller
{
    public function create()
    {
        return Inertia::render('Scrum/Sprint/Create');
    }
}
