<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('characters', CharacterController::class);
require __DIR__.'/auth.php';
Route::get('/users/{user:name}/characters', [CharacterController::class, 'index'])->name('users.characters');
Route::get('/users/{user:name}/feed', [UserController::class, 'feed'])->name('users.feed');

Route::post('/users/{user:name}/befriend', [UserController::class, 'befriend'])->name('users.befriend');
Route::post('/users/{user:name}/unfriend', [UserController::class, 'unfriend'])->name('users.unfriend');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::post('/characters/{id}/restore', [CharacterController::class, 'restore'])->name('characters.restore')->middleware(['auth']);
Route::post('/characters/{id}/purge', [CharacterController::class, 'purge'])->name('characters.purge')->middleware(['auth']);

Route::get('/characters/{character}/items', [ItemController::class, 'index'])
    ->name('items.index');
Route::get('/characters/{character}/items/create', [ItemController::class, 'create'])
    ->name('items.create');
Route::post('/characters/{character}/items', [ItemController::class, 'store'])
    ->name('items.store');
