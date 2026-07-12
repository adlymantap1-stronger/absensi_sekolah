<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Students\Index as StudentsIndex;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/students', StudentsIndex::class)->name('students.index');
});

require __DIR__.'/auth.php';