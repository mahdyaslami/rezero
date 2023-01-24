<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\Scrum\SprintController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/oauth/github/redirect', [OAuthController::class, 'redirect'])
    ->name('github.redirect');
    
    Route::get('/oauth/github/callback', [OAuthController::class, 'callback'])
    ->name('github.callback');

    Route::resource('notes', NoteController::class)->except(['create', 'edit', 'show']);

    Route::resource('scrum/sprints', SprintController::class);
});