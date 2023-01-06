<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('deploy', function () {
    $liara = new Process(['liara', 'deploy', '--detach']);
    $liara->start();

    while ($liara->isRunning()) {
        echo $liara->getIncrementalOutput();
    }

    $migration = new Process(['liara', 'shell', '-c="php artisan migrate --no-interaction"']);
    $migration->start();

    while ($migration->isRunning()) {
        echo $migration->getIncrementalOutput();
    }
})->purpose('deploy and migrate');
