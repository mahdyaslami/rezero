<?php

use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return 'Rezero Applications Federation';
});

Route::get('/passwords/{path?}', fn () => view('passwords'))
    ->where('path', '.*');

Route::post('/dictionaries', [DictionaryController::class, 'store']);
