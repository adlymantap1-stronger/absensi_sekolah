<?php

namespace App\Livewire\Attendances;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public $class_room_id = '';
    public $date;

    // Menyimpan status absensi tiap siswa: [student_id => status]
    public $statuses = [];

    public $classRooms = [];
    public $students = [];

    // True kalau absensi kelas+tanggal ini sudah pernah disimpan sebelumnya (terkunci, tidak bisa diubah lagi)
    public $isLocked = false;

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->classRooms = ClassRoom::with('major')->get();

        // Otomatis pilih kelas pertama supaya siswa langsung tampil tanpa perlu klik manual
        if ($this->classRooms->isNotEmpty()) {
            $this->class_room_id = $this->classRooms->first()->id;
            $this->loadStudents();
        }
    }

    // Setiap kali kelas dipilih, load siswa di kelas itu + cek absensi yang sudah ada hari itu
    public function updatedClassRoomId()
    {
        $this->loadStudents();
    }

    public function updatedDate()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        if (!$this->class_room_id) {
            $this->students = [];
            return;
        }

        $this->students = Student::where('class_room_id', $this->class_room_id)
            ->orderBy('name')
            ->get();

        $existing = Attendance::where('date', $this->date)
            ->whereIn('student_id', $this->students->pluck('id'))
            ->pluck('status', 'student_id');

        $this->isLocked = $existing->isNotEmpty();

        foreach ($this->students as $student) {
            $this->statuses[$student->id] = $existing[$student->id] ?? 'hadir';
        }
    }

    public function save()
    {
        $this->validate([
            'class_room_id' => 'required|exists:class_rooms,id',
            'date' => 'required|date',
        ]);


        if ($this->isLocked) {
            session()->flash('error', 'Absensi untuk kelas dan tanggal ini sudah dikunci dan tidak bisa diubah lagi.');
            return;
        }

        foreach ($this->statuses as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $this->date,
                ],
                [
                    'status' => $status,
                    'created_by' => Auth::id(),
                ]
            );
        }

        session()->flash('success', 'Absensi berhasil disimpan untuk ' . count($this->statuses) . ' siswa.');
        $this->loadStudents(); // refresh biar status terkunci kelihatan
    }

    public function render()
    {
        return view('livewire.attendances.create');
    }
}