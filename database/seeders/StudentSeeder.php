<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $firstNames = [
            'Ahmad', 'Siti', 'Budi', 'Dewi', 'Rizki', 'Nur', 'Andi', 'Putri', 'Fajar', 'Indah',
            'Doni', 'Ratna', 'Eko', 'Wulan', 'Agus', 'Yuni', 'Hendra', 'Sri', 'Bayu', 'Lestari',
        ];
        $lastNames = [
            'Santoso', 'Lestari', 'Pratama', 'Wulandari', 'Saputra', 'Ramadhan', 'Permata',
            'Setiawan', 'Sari', 'Prasetyo', 'Suci', 'Salim', 'Astuti', 'Gunawan', 'Wahyuni', 'Aji',
        ];

        // Tiap kelas diisi 6-10 siswa dengan nama acak tapi tidak berulang dalam 1 kelas
        ClassRoom::all()->each(function ($classRoom) use ($firstNames, $lastNames) {
            $jumlah = rand(6, 10);
            $usedNames = [];

            for ($i = 0; $i < $jumlah; $i++) {
                do {
                    $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
                } while (in_array($name, $usedNames));

                $usedNames[] = $name;

                Student::create([
                    'class_room_id' => $classRoom->id,
                    'name' => $name,
                    'gender' => rand(0, 1) ? 'L' : 'P',
                ]);
            }
        });
    }
}