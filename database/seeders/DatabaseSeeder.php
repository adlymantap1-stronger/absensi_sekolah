<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MajorSeeder::class,
            ClassRoomSeeder::class,
            StudentSeeder::class,
        ]);

        // Akun Admin — akses penuh semua data
        User::factory()->create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Akun Wali Kelas — dibatasi cuma kelas yang dia pegang
        $waliKelas = User::factory()->create([
            'name' => 'Budi Wali Kelas',
            'email' => 'walikelas@example.com',
            'role' => 'wali_kelas',
        ]);

        // Tugaskan wali kelas ini ke kelas pertama sebagai contoh
        $firstClass = ClassRoom::first();
        if ($firstClass) {
            $firstClass->update(['wali_kelas_id' => $waliKelas->id]);
        }
    }
}