<?php

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Support\Carbon;

/**
 * Service untuk kalkulasi statistik kehadiran, dipakai di Dashboard dan Report.
 * Dipisah dari Livewire component supaya logic bisnis tidak bercampur dengan UI (Coding Standard: STRUCTURE).
 */
class AttendanceStatsService
{
    // Ringkasan kehadiran untuk 1 tanggal tertentu, dikelompokkan per status
    public function getDailySummary(string $date): array
    {
        $counts = Attendance::where('date', $date)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'hadir' => $counts['hadir'] ?? 0,
            'sakit' => $counts['sakit'] ?? 0,
            'izin' => $counts['izin'] ?? 0,
            'alpa' => $counts['alpa'] ?? 0,
            'total' => $counts->sum(),
        ];
    }

    // Statistik persentase kehadiran untuk 7 hari terakhir (dipakai chart mingguan Dashboard)
    public function getWeeklyStats(): \Illuminate\Support\Collection
    {
        return collect(range(6, 0))->map(function ($daysAgo) {
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
    }
}