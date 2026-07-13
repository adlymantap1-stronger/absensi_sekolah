<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $totalSiswa = Student::count();
        $totalKelas = ClassRoom::count();

        // Ringkasan kehadiran hari ini, dikelompokkan per status
        $todayAttendance = Attendance::where('date', now()->format('Y-m-d'))
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $hadirHariIni = $todayAttendance['hadir'] ?? 0;
        $sakitHariIni = $todayAttendance['sakit'] ?? 0;
        $izinHariIni = $todayAttendance['izin'] ?? 0;
        $alpaHariIni = $todayAttendance['alpa'] ?? 0;
        $sudahAbsenHariIni = $todayAttendance->sum();

        // Statistik kehadiran 7 hari terakhir, untuk chart mingguan
        $weeklyStats = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->format('Y-m-d');
            $hadir = Attendance::where('date', $date)->where('status', 'hadir')->count();
            $total = Attendance::where('date', $date)->count();

            return [
                'date' => Carbon::parse($date)->translatedFormat('d M'),
                'hadir' => $hadir,
                'total' => $total,
                'persentase' => $total > 0 ? round(($hadir / $total) * 100) : 0,
            ];
        });

        return view('livewire.dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalKelas' => $totalKelas,
            'hadirHariIni' => $hadirHariIni,
            'sakitHariIni' => $sakitHariIni,
            'izinHariIni' => $izinHariIni,
            'alpaHariIni' => $alpaHariIni,
            'sudahAbsenHariIni' => $sudahAbsenHariIni,
            'weeklyStats' => $weeklyStats,
        ]);
    }
}