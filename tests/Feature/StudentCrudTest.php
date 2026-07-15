<?php

namespace Tests\Feature;

use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\Students\Index as StudentsIndex;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    protected ClassRoom $classRoom;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $major = Major::create(['name' => 'Layanan Perbankan', 'code' => 'LPB']);
        $this->classRoom = ClassRoom::create(['major_id' => $major->id, 'grade_level' => 'X', 'name' => 'X LPB 1']);
    }

    /** @test */
    public function bisa_menambah_siswa_baru(): void
    {
        Livewire::test(StudentsIndex::class)
            ->set('name', 'Budi Santoso')
            ->set('gender', 'L')
            ->set('class_room_id', $this->classRoom->id)
            ->call('save');

        $this->assertDatabaseHas('students', [
            'name' => 'Budi Santoso',
            'gender' => 'L',
            'class_room_id' => $this->classRoom->id,
        ]);
    }

    /** @test */
    public function nama_siswa_wajib_diisi(): void
    {
        Livewire::test(StudentsIndex::class)
            ->set('name', '')
            ->set('gender', 'L')
            ->set('class_room_id', $this->classRoom->id)
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function bisa_mengedit_data_siswa(): void
    {
        $student = Student::create([
            'class_room_id' => $this->classRoom->id,
            'name' => 'Nama Lama',
            'gender' => 'L',
        ]);

        Livewire::test(StudentsIndex::class)
            ->call('openEditModal', $student->id)
            ->set('name', 'Nama Baru')
            ->call('save');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Nama Baru',
        ]);
    }

    /** @test */
    public function bisa_menghapus_siswa_soft_delete(): void
    {
        $student = Student::create([
            'class_room_id' => $this->classRoom->id,
            'name' => 'Akan Dihapus',
            'gender' => 'P',
        ]);

        Livewire::test(StudentsIndex::class)
            ->call('delete', $student->id);

        // Soft delete: record masih ada di database, tapi deleted_at terisi
        $this->assertSoftDeleted('students', ['id' => $student->id]);
    }

    /** @test */
    public function pencarian_siswa_berdasarkan_nama_berfungsi(): void
    {
        Student::create(['class_room_id' => $this->classRoom->id, 'name' => 'Ahmad Fauzi', 'gender' => 'L']);
        Student::create(['class_room_id' => $this->classRoom->id, 'name' => 'Siti Aisyah', 'gender' => 'P']);

        Livewire::test(StudentsIndex::class)
            ->set('search', 'Ahmad')
            ->assertSee('Ahmad Fauzi')
            ->assertDontSee('Siti Aisyah');
    }
}