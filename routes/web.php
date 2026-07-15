<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Students\Index as StudentsIndex;
use App\Livewire\Students\Show as StudentsShow;
use App\Livewire\Attendances\Create as AttendancesCreate;
use App\Livewire\Attendances\Index as AttendancesIndex;
use App\Livewire\Reports\Index as ReportsIndex;
use App\Livewire\Dashboard;
use App\Livewire\Attendances\Calendar as AttendancesCalendar;

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
    Route::get('/students/{student}', StudentsShow::class)->name('students.show');
});

Route::get('/attendances/calendar', AttendancesCalendar::class)->name('attendances.calendar');

require __DIR__.'/auth.php';