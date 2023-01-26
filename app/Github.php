<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Github
{
    public static function repositories()
    {
        $client = app('github.api');
        $client->authenticate(
            auth()->user()->github->token,
            \Github\AuthMethod::ACCESS_TOKEN
        );

        $result = Cache::remember(
            auth()->user()->github->username . ':repos',
            300,
            fn () => $client->api('me')->repositories()
        );

        $result = collect($result);

        return $result->map(fn ($r) =>  Arr::only($r, ['id', 'name']));
    }
}
