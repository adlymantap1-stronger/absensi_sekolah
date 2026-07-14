<?php

namespace App\Rules;

use App\Models\Attendance;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Business rule: satu siswa hanya boleh punya satu absensi per hari.
 * Dipakai sebagai lapisan validasi eksplisit, selain unique constraint di database.
 */
class UniqueAttendancePerDay implements ValidationRule
{
    public function __construct(
        protected int $studentId,
        protected string $date,
        protected ?int $ignoreAttendanceId = null
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = Attendance::where('student_id', $this->studentId)
            ->where('date', $this->date)
            ->when($this->ignoreAttendanceId, fn ($q) => $q->where('id', '!=', $this->ignoreAttendanceId))
            ->exists();

        if ($exists) {
            $fail('Siswa ini sudah memiliki catatan absensi pada tanggal tersebut.');
        }
    }
}