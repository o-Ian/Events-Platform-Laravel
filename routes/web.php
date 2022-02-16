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

Route::get('events/create', [EventController::class, 'create'])->name('site.create')->middleware('auth');
Route::post('events/create', [EventController::class, 'store'])->name('site.create.post')->middleware('auth');

Route::get('events/show/{event}', [EventController::class, 'show'])->name('site.show');

Route::get('dashboard', [EventController::class, 'dashboard'])->name('site.dashboard')->middleware('auth');
Route::delete('events/delete/{event}', [EventController::class, 'destroy'])->name('site.delete')->middleware('auth');

Route::get('events/edit/{event}', [EventController::class, 'edit'])->name('site.update')->middleware('auth');
Route::put('events/edit/{event}', [EventController::class, 'update'])->name('site.update.edit')->middleware('auth');

Route::post('events/join/{event}', [EventController::class, 'joinEvent'])->name('site.join.event')->middleware('auth');

Route::delete('events/leave/{event}', [EventController::class, 'leaveEvent'])->name('site.leave.event')->middleware('auth');
