<?php

namespace App\Http\Controllers;

use App\Http\Requests\DictionaryRequest;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function store(DictionaryRequest $request)
    {
        Dictionary::updateOrCreate(
            ['key' => $request->get('key')],
            ['value'=> $request->get('value')]
        );
    }
}
