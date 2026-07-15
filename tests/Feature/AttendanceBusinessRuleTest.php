<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceBusinessRuleTest extends TestCase
{
    use RefreshDatabase;

    protected Student $student;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'admin']);

        $major = Major::create(['name' => 'Sistem Informasi Jaringan dan Aplikasi', 'code' => 'SIJA']);
        $classRoom = ClassRoom::create(['major_id' => $major->id, 'grade_level' => 'X', 'name' => 'X SIJA 1']);
        $this->student = Student::create(['class_room_id' => $classRoom->id, 'name' => 'Test Siswa', 'gender' => 'L']);
    }

    /** @test */
    public function satu_siswa_tidak_boleh_memiliki_dua_absensi_di_tanggal_yang_sama(): void
    {
        Attendance::create([
            'student_id' => $this->student->id,
            'date' => '2026-07-14',
            'status' => 'hadir',
            'created_by' => $this->user->id,
        ]);

        // Percobaan insert kedua untuk siswa & tanggal yang sama harus gagal
        // karena unique constraint di database (student_id + date).
        $this->expectException(\Illuminate\Database\QueryException::class);

        Attendance::create([
            'student_id' => $this->student->id,
            'date' => '2026-07-14',
            'status' => 'sakit',
            'created_by' => $this->user->id,
        ]);
    }

    /** @test */
    public function update_or_create_tidak_membuat_duplikat_untuk_siswa_dan_tanggal_yang_sama(): void
    {
        Attendance::updateOrCreate(
            ['student_id' => $this->student->id, 'date' => '2026-07-14'],
            ['status' => 'hadir', 'created_by' => $this->user->id]
        );

        Attendance::updateOrCreate(
            ['student_id' => $this->student->id, 'date' => '2026-07-14'],
            ['status' => 'sakit', 'created_by' => $this->user->id]
        );

        // Harus tetap 1 record, bukan 2
        $this->assertEquals(1, Attendance::where('student_id', $this->student->id)
            ->where('date', '2026-07-14')
            ->count());

        // Status harus ter-update jadi 'sakit', bukan 'hadir'
        $this->assertEquals('sakit', Attendance::where('student_id', $this->student->id)
            ->where('date', '2026-07-14')
            ->first()->status);
    }

    /** @test */
    public function siswa_yang_sama_boleh_memiliki_absensi_di_tanggal_berbeda(): void
    {
        Attendance::create([
            'student_id' => $this->student->id,
            'date' => '2026-07-14',
            'status' => 'hadir',
            'created_by' => $this->user->id,
        ]);

        Attendance::create([
            'student_id' => $this->student->id,
            'date' => '2026-07-15',
            'status' => 'sakit',
            'created_by' => $this->user->id,
        ]);

        $this->assertEquals(2, Attendance::where('student_id', $this->student->id)->count());
    }
}