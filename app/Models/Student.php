<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['class_room_id', 'name', 'gender'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}