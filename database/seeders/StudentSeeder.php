<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake('id_ID');

        $firstNames = [
            'Ahmad', 'Siti', 'Budi', 'Dewi', 'Rizki', 'Nur', 'Andi', 'Putri', 'Fajar', 'Indah',
            'Doni', 'Ratna', 'Eko', 'Wulan', 'Agus', 'Yuni', 'Hendra', 'Sri', 'Bayu', 'Lestari',
        ];

        $lastNames = [
            'Santoso', 'Lestari', 'Pratama', 'Wulandari', 'Saputra', 'Ramadhan', 'Permata',
            'Setiawan', 'Sari', 'Prasetyo', 'Suci', 'Salim', 'Astuti', 'Gunawan', 'Wahyuni', 'Aji',
        ];

        ClassRoom::all()->each(function ($classRoom) use ($firstNames, $lastNames, $faker) {
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
                    'tanggal_lahir' => $faker->dateTimeBetween('-18 years', '-15 years')->format('Y-m-d'),
                    'alamat' => $faker->address(),
                    'nama_orang_tua' => $faker->name(),
                    'no_hp_orang_tua' => '08' . $faker->numerify('##########'),
                ]);
            }
        });
    }
}