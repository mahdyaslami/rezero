<?php

namespace App\Http\Requests\Scrum;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->id == $this->route('sprint')->user_id;
    }

    public function rules()
    {
        return [
            'issues' => 'present|array',
            'issues.*.id' => 'required|integer',
            'issues.*.title' => 'required',
            'issues.*.html_url' => 'required',
        ];
    }
}
