<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained()->cascadeOnDelete();

            // Nullable karena kelas bisa dibuat dulu sebelum wali kelas ditentukan
            $table->foreignId('wali_kelas_id')->nullable()->constrained('users')->nullOnDelete();

            
            $table->enum('grade_level', ['X', 'XI', 'XII', 'XIII']);
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
