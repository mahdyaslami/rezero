<?php

namespace App;

use Github\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Github
{
    private Client $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function repositories(): Collection
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

    public function issues(string $repo)
    {
        $this->client->authenticate(
            auth()->user()->github->token,
            \Github\AuthMethod::ACCESS_TOKEN
        );

        $result = Cache::remember(
            auth()->user()->github->username . ':' . $repo . ':issues',
            300,
            fn () => $this->client->api('issues')->all(
                auth()->user()->github->username,
                $repo,
                array('state' => 'open')
            )
        );

        $result = collect($result);

        return $result;
    }
}
