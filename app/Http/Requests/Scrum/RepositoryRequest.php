<?php

namespace App\Http\Requests\Scrum;

use Illuminate\Foundation\Http\FormRequest;

class RepositoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'repos' => 'present|array',
            'repos.*.id' => 'required|integer',
            'repos.*.name' => 'required'
        ];
    }
}
