<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;
use App\Models\Character;
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

Route::get('/', function () {
    return redirect('/characters');
    return view('welcome');
});

//Route::get('/characters', [CharacterController::class, 'index']);
//Route::post('/characters/{id}/edit', [CharacterController::class, 'store']);
//Route::get('/characters/{id}/edit', [CharacterController::class, 'edit']);
//Route::get('/characters/{character}', [CharacterController::class, 'show']);

Route::resource('characters', CharacterController::class);
