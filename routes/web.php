<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Students\Index as StudentsIndex;
use App\Livewire\Attendances\Create as AttendancesCreate;
use App\Livewire\Attendances\Index as AttendancesIndex;

Route::view('/', 'dashboard');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/students', StudentsIndex::class)->name('students.index');
    Route::get('/attendances/create', AttendancesCreate::class)->name('attendances.create');
});

Route::get('/attendances', AttendancesIndex::class)->name('attendances.index');

require __DIR__.'/auth.php';