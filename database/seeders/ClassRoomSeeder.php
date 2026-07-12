<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Major;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    public function run(): void
    {
        $lpb = Major::where('code', 'LPB')->first();
        $dkv = Major::where('code', 'DKV')->first();
        $sija = Major::where('code', 'SIJA')->first();

        $gradeLevels = ['X', 'XI', 'XII'];

        foreach ($gradeLevels as $grade) {
            // Semua kelas LPB dulu (3 rombel)
            for ($i = 1; $i <= 3; $i++) {
                ClassRoom::create([
                    'major_id' => $lpb->id,
                    'grade_level' => $grade,
                    'name' => "{$grade} LPB {$i}",
                ]);
            }

            // Baru semua kelas DKV (3 rombel)
            for ($i = 1; $i <= 3; $i++) {
                ClassRoom::create([
                    'major_id' => $dkv->id,
                    'grade_level' => $grade,
                    'name' => "{$grade} DKV {$i}",
                ]);
            }

            // Baru semua kelas SIJA (2 rombel)
            for ($i = 1; $i <= 2; $i++) {
                ClassRoom::create([
                    'major_id' => $sija->id,
                    'grade_level' => $grade,
                    'name' => "{$grade} SIJA {$i}",
                ]);
            }
        }

        // XIII khusus SIJA, 1 kelas saja
        ClassRoom::create([
            'major_id' => $sija->id,
            'grade_level' => 'XIII',
            'name' => 'XIII SIJA 1',
        ]);
    }
}