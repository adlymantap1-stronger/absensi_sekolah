<?php

namespace App\Livewire\Attendances;

use App\Models\Attendance;
use App\Models\ClassRoom;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $date;
    public $filterClassRoom = '';
    public $filterStudent = '';

    public $classRooms = [];

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->classRooms = ClassRoom::with('major')->get();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }

    public function updatingFilterClassRoom()
    {
        $this->resetPage();
    }

    public function updatingFilterStudent()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Eager load student.classRoom.major untuk hindari N+1 query
        $attendances = Attendance::query()
            ->with('student.classRoom.major', 'recorder')
            ->where('date', $this->date)
            ->when($this->filterClassRoom, fn ($q) => $q->whereHas('student', fn ($sq) => $sq->where('class_room_id', $this->filterClassRoom)))
            ->when($this->filterStudent, fn ($q) => $q->whereHas('student', fn ($sq) => $sq->where('name', 'like', '%' . $this->filterStudent . '%')))
            ->latest()
            ->paginate(15);

        return view('livewire.attendances.index', [
            'attendances' => $attendances,
        ]);
    }
}