<?php

namespace App\Livewire;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Services\AttendanceStatsService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render(AttendanceStatsService $statsService)
    {
        $daily = $statsService->getDailySummary(now()->format('Y-m-d'));

        return view('livewire.dashboard', [
            'totalSiswa' => Student::count(),
            'totalKelas' => ClassRoom::count(),
            'hadirHariIni' => $daily['hadir'],
            'sakitHariIni' => $daily['sakit'],
            'izinHariIni' => $daily['izin'],
            'alpaHariIni' => $daily['alpa'],
            'sudahAbsenHariIni' => $daily['total'],
            'weeklyStats' => $statsService->getWeeklyStats(),
        ]);
    }
}