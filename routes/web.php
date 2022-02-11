<?php

use App\Http\Controllers\EventController;
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

Route::get('/', [EventController::class, 'index'])->name('site.home');

Route::get('events/create', [EventController::class, 'create'])->name('site.create');
Route::post('events/create', [EventController::class, 'store'])->name('site.create.post');

Route::get('events/show/{event}', [EventController::class, 'show'])->name('site.show');
