<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use SoftDeletes;

    Protected $fillable = ['major_id', 'wali_kelas_id', 'grade_level', 'name'];


    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
