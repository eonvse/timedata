<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Livewire\MonthTable;
use App\Livewire\WeekTable;

use App\Livewire\TimeEvents;
use App\Livewire\Info\TimeEvent;

use App\Livewire\Data\Users;
use App\Livewire\Info\User;

use App\Livewire\Data\Teams;
use App\Livewire\Info\Team;

use App\Http\Controllers\FileController;

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
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/timedata/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/timedata/public/livewire/update', $handle)
        ->middleware(['auth', 'verified']); 
});

Route::get('/', Teams::class)->middleware(['auth', 'verified'])->name('welcome');

Route::get('/colors', function () {
    return view('colors');
});

Route::get('/dashboard', Teams::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/extra', [ProfileController::class, 'updateExtra'])->name('profile.update.extra');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/month-table', MonthTable::class)->name('month-table');
    Route::get('/week-table', WeekTable::class)->name('week-table');

    Route::get('/users', Users::class)->name('data.users');
    Route::get('/users/{id}/{edit?}', User::class)->name('info.user');

    Route::get('/teams', Teams::class)->name('data.teams');
    Route::get('/teams/{id}/{edit?}', Team::class)->name('info.team');

    Route::get('/time-events', TimeEvents::class)->name('time-events');
    Route::get('/time-events/{id}/{edit?}', TimeEvent::class)->name('info.time-event');



});

require __DIR__.'/auth.php';
