<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class ShadowSamaController extends Controller
{
    public function categories()
    {
        $categories = collect(
            json_decode(
                \Storage::disk('public')->get('/shadow-sama/shadow-sama.json'),
                true
            )
        );

        return JsonResource::collection($categories);
    }
}
