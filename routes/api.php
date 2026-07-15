<?php

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students', function () {
        return Student::with('classRoom.major')->paginate(20);
    });

    Route::get('/students/{student}', function (Student $student) {
        return $student->load('classRoom.major');
    });

    Route::get('/attendances', function (Request $request) {
        return Attendance::with('student.classRoom')
            ->when($request->date, fn($q) => $q->where('date', $request->date))
            ->when($request->class_room_id, fn($q) => $q->whereHas('student', fn($sq) => $sq->where('class_room_id', $request->class_room_id)))
            ->paginate(20);
    });
});