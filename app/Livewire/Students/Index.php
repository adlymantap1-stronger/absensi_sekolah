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
    // Untuk pencarian & filter
    public $search = '';
    public $filterClassRoom = '';

    // Untuk pencarian & filter (requirement: "Pencarian dan filter siswa")
    public $name = '';
    public $gender = '';
    public $class_room_id = '';
    public $tanggal_lahir = '';
    public $alamat = '';
    public $nama_orang_tua = '';
    public $no_hp_orang_tua = '';

    public ?int $editingId = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'class_room_id' => 'required|exists:class_rooms,id',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|string|max:20',
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
        $this->tanggal_lahir = $student->tanggal_lahir?->format('Y-m-d');
        $this->alamat = $student->alamat;
        $this->nama_orang_tua = $student->nama_orang_tua;
        $this->no_hp_orang_tua = $student->no_hp_orang_tua;
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
                'tanggal_lahir' => $this->tanggal_lahir,
                'alamat' => $this->alamat,
                'nama_orang_tua' => $this->nama_orang_tua,
                'no_hp_orang_tua' => $this->no_hp_orang_tua,
            ]
        );

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete(int $id)
    {
        Student::findOrFail($id)->delete(); // soft delete
    }

    public function resetForm()
    {
        $this->reset(['name', 'gender', 'class_room_id', 'tanggal_lahir', 'alamat', 'nama_orang_tua', 'no_hp_orang_tua', 'editingId']);
    }

    public function render()
    {
        $students = Student::query()
            ->with('classRoom.major')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filterClassRoom, fn($q) => $q->where('class_room_id', $this->filterClassRoom))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.students.index', [
            'students' => $students,
            'classRooms' => ClassRoom::with('major')->get(),
        ]);
    }
}