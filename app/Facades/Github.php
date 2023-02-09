<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection repositories()
 */
class Github extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Github';
    }
}
