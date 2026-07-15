<?php

namespace App\Livewire\Attendances;

use App\Models\Attendance;
use App\Models\ClassRoom;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Calendar extends Component
{
    public $month;
    public $year;
    public $classRoomId = '';
    public $classRooms = [];

    public function mount()
    {
        $this->month = now()->format('m');
        $this->year = now()->format('Y');
        $this->classRooms = ClassRoom::with('major')->get();

        if ($this->classRooms->isNotEmpty()) {
            $this->classRoomId = $this->classRooms->first()->id;
        }
    }

    // Menghasilkan data kalender: tiap tanggal dalam bulan dipetakan ke ringkasan kehadiran hari itu
    public function getCalendarDaysProperty()
    {
        $startOfMonth = Carbon::create($this->year, $this->month, 1);
        $daysInMonth = $startOfMonth->daysInMonth;
        // Offset supaya kalender mulai dari hari Senin (1 = Senin di Carbon)
        $startOffset = $startOfMonth->dayOfWeekIso - 1;

        $attendancesByDate = Attendance::query()
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->when($this->classRoomId, fn ($q) => $q->whereHas('student', fn ($sq) => $sq->where('class_room_id', $this->classRoomId)))
            ->get()
            ->groupBy(fn ($a) => Carbon::parse($a->date)->format('j'));

        $days = [];

        // Sel kosong sebelum tanggal 1 (supaya grid kalender rapi mulai dari hari yang benar)
        for ($i = 0; $i < $startOffset; $i++) {
            $days[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $records = $attendancesByDate->get((string) $day, collect());
            $total = $records->count();
            $hadir = $records->where('status', 'hadir')->count();

            $days[] = [
                'day' => $day,
                'total' => $total,
                'persentase' => $total > 0 ? round(($hadir / $total) * 100) : null,
            ];
        }

        return $days;
    }

    public function render()
    {
        return view('livewire.attendances.calendar');
    }
}