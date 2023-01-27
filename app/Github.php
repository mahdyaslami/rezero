<?php

namespace App;

use Github\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Github
{
    private Client $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function repositories()
    {
        $this->client->authenticate(
            auth()->user()->github->token,
            \Github\AuthMethod::ACCESS_TOKEN
        );

        $result = Cache::remember(
            auth()->user()->github->username . ':repos',
            300,
            fn () => $this->client->api('me')->repositories()
        );

        $result = collect($result);

        return $result->map(fn ($r) =>  Arr::only($r, ['id', 'name']));
    }
}