<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            ['name' => 'Layanan Perbankan', 'code' => 'LPB'],
            ['name' => 'Desain Komunikasi Visual', 'code' => 'DKV'],
            ['name' => 'Sistem Informasi Jaringan dan Aplikasi', 'code' => 'SIJA'],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }
    }
}