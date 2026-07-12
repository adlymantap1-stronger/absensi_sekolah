<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use SoftDeletes;

    protected $table = 'class_rooms';

    protected $fillable = ['major_id', 'wali_kelas_id', 'grade_level', 'name'];

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