<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function store()
    {
        Dictionary::updateOrCreate(
            ['key' => request()->get('key')],
            ['value'=> request()->get('value')]
        );
    }
}
