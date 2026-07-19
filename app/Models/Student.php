<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['class_room_id', 'name', 'gender', 'tanggal_lahir', 'alamat', 'nama_orang_tua', 'no_hp_orang_tua'];

     protected $casts = [ 'tanggal_lahir' => 'date'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}