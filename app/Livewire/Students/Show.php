<?php

namespace App\Livewire\Students;

use App\Models\Attendance;
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Student $student;

    public function mount(Student $student)
    {
        $this->student = $student->load('classRoom.major');
    }

    // Statistik kehadiran keseluruhan siswa ini (sepanjang waktu tercatat)
    public function getStatsProperty()
    {
        $attendances = Attendance::where('student_id', $this->student->id)->get();

        $total = $attendances->count();
        $hadir = $attendances->where('status', 'hadir')->count();

        return [
            'hadir' => $hadir,
            'sakit' => $attendances->where('status', 'sakit')->count(),
            'izin' => $attendances->where('status', 'izin')->count(),
            'alpa' => $attendances->where('status', 'alpa')->count(),
            'total' => $total,
            'persentase' => $total > 0 ? round(($hadir / $total) * 100) : 0,
        ];
    }

    // Riwayat absensi terbaru siswa ini, 10 catatan terakhir
    public function getRecentAttendancesProperty()
    {
        return Attendance::where('student_id', $this->student->id)
            ->latest('date')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.students.show');
    }
}