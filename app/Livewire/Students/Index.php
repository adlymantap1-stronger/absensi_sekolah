<?php

namespace App\Livewire\Students;

use App\Models\Student;
use App\Models\ClassRoom;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    // Untuk pencarian & filter (requirement: "Pencarian dan filter siswa")
    public $search = '';
    public $filterClassRoom = '';

    // Field form tambah/edit siswa
    public $name = '';
    public $gender = '';
    public $class_room_id = '';

    public $editingId = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'class_room_id' => 'required|exists:class_rooms,id',
        ];
    }

    // Reset ke halaman 1 tiap kali search/filter berubah, supaya tidak nyasar ke halaman kosong
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterClassRoom()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $student = Student::findOrFail($id);
        $this->editingId = $student->id;
        $this->name = $student->name;
        $this->gender = $student->gender;
        $this->class_room_id = $student->class_room_id;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        Student::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name' => $this->name,
                'gender' => $this->gender,
                'class_room_id' => $this->class_room_id,
            ]
        );

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete(); // soft delete
    }

    public function resetForm()
    {
        $this->reset(['name', 'gender', 'class_room_id', 'editingId']);
    }

    public function render()
    {
        // Eager load classRoom.major untuk hindari N+1 query (sesuai non-functional requirement)
        $students = Student::query()
            ->with('classRoom.major')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filterClassRoom, fn($q) => $q->where('class_room_id', $this->filterClassRoom))
            ->latest()
            ->paginate(10);

        return view('livewire.students.index', [
            'students' => $students,
            'classRooms' => ClassRoom::with('major')->get(),
        ]);
    }
}