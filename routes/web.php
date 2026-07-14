<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Students\Index as StudentsIndex;
use App\Livewire\Attendances\Create as AttendancesCreate;
use App\Livewire\Attendances\Index as AttendancesIndex;
use App\Livewire\Reports\Index as ReportsIndex;
use App\Livewire\Dashboard;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/students', StudentsIndex::class)->name('students.index');
    Route::get('/attendances/create', AttendancesCreate::class)->name('attendances.create');
    Route::get('/attendances', AttendancesIndex::class)->name('attendances.index');
    Route::get('/reports', ReportsIndex::class)->name('reports.index');
});

require __DIR__.'/auth.php';