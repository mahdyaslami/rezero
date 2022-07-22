<?php

function domain($subdomain = null) {
    $domain = config('app.domain');

    if ($subdomain) {
        return "$subdomain.$domain";
    }

    return $domain;
}