<?php

namespace App\Livewire\Attendances;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Create extends Component
{
    use WithPagination;

    public $class_room_id = '';
    public $date;

    public $statuses = [];
    public $classRooms = [];
    public $students = [];
    public $isLocked = false;

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->classRooms = ClassRoom::with('major')->get();
        // Default mode: "Semua Kelas" (lihat semua siswa, read-only, dengan pagination)
    }

    public function updatedClassRoomId()
    {
        $this->resetPage();
        $this->loadStudents();
    }

    public function updatedDate()
    {
        $this->resetPage();
        $this->loadStudents();
    }

    public function loadStudents()
    {
        if (!$this->class_room_id) {
            $this->students = [];
            $this->isLocked = false;
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

    // Computed property: daftar semua siswa (semua kelas) untuk mode "Semua Kelas", dengan pagination.
    // Hanya dipakai kalau belum ada kelas spesifik yang dipilih.
    public function getAllStudentsProperty()
    {
        if ($this->class_room_id) {
            return null;
        }

        $paginated = Student::with('classRoom')
            ->orderBy('class_room_id')
            ->orderBy('name')
            ->paginate(15);

        // Ambil status absensi hari ini khusus untuk siswa di halaman ini saja (efisien, bukan semua 205 siswa)
        $existing = Attendance::where('date', $this->date)
            ->whereIn('student_id', $paginated->pluck('id'))
            ->pluck('status', 'student_id');

        $paginated->getCollection()->transform(function ($student) use ($existing) {
            $student->today_status = $existing[$student->id] ?? null;
            return $student;
        });

        return $paginated;
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
                ['student_id' => $studentId, 'date' => $this->date],
                ['status' => $status, 'created_by' => Auth::id()]
            );
        }

        session()->flash('success', 'Absensi berhasil disimpan untuk ' . count($this->statuses) . ' siswa.');
        $this->loadStudents();
    }

    public function render()
    {
        return view('livewire.attendances.create');
    }
}