<?php

namespace App\Livewire\Reports;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $month;
    public $year;
    public $filterClassRoom = '';

    public $classRooms = [];

    public function mount()
    {
        $this->month = now()->format('m');
        $this->year = now()->format('Y');
        $this->classRooms = ClassRoom::with('major')->get();
    }

    // Menghitung rekap kehadiran tiap siswa dalam bulan yang dipilih:
    // jumlah hadir/sakit/izin/alpa, dan persentase kehadiran = hadir / total hari tercatat.
    public function getRekapProperty()
    {
        $students = Student::query()
            ->with('classRoom.major')
            ->when($this->filterClassRoom, fn ($q) => $q->where('class_room_id', $this->filterClassRoom))
            ->orderBy('name')
            ->get();

        return $students->map(function ($student) {
            $attendances = Attendance::where('student_id', $student->id)
                ->whereYear('date', $this->year)
                ->whereMonth('date', $this->month)
                ->get();

            $total = $attendances->count();
            $hadir = $attendances->where('status', 'hadir')->count();
            $sakit = $attendances->where('status', 'sakit')->count();
            $izin = $attendances->where('status', 'izin')->count();
            $alpa = $attendances->where('status', 'alpa')->count();

            return [
                'student' => $student,
                'hadir' => $hadir,
                'sakit' => $sakit,
                'izin' => $izin,
                'alpa' => $alpa,
                'total' => $total,
                'persentase' => $total > 0 ? round(($hadir / $total) * 100) : 0,
            ];
        });
    }

    // Export rekap bulan ini ke file CSV
    public function exportCsv()
    {
        $rekap = $this->rekap;
        $filename = 'rekap-absensi-' . $this->year . '-' . $this->month . '.csv';

        return response()->streamDownload(function () use ($rekap) {
            $handle = fopen('php://output', 'w');

            // Header kolom
            fputcsv($handle, ['Nama Siswa', 'Kelas', 'Jurusan', 'Hadir', 'Sakit', 'Izin', 'Alpa', 'Total Tercatat', 'Persentase Kehadiran']);

            foreach ($rekap as $row) {
                fputcsv($handle, [
                    $row['student']->name,
                    $row['student']->classRoom->name,
                    $row['student']->classRoom->major->code,
                    $row['hadir'],
                    $row['sakit'],
                    $row['izin'],
                    $row['alpa'],
                    $row['total'],
                    $row['persentase'] . '%',
                ]);
            }

            fclose($handle);
        }, $filename);
    }

    public function render()
    {
        return view('livewire.reports.index');
    }
}