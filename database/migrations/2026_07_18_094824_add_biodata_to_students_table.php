<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date('tanggal_lahir')->nullable()->after('gender');
            $table->text('alamat')->nullable()->after('tanggal_lahir');
            $table->string('nama_orang_tua')->nullable()->after('alamat');
            $table->string('no_hp_orang_tua', 20)->nullable()->after('nama_orang_tua');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['tanggal_lahir', 'alamat', 'nama_orang_tua', 'no_hp_orang_tua']);
        });
    }
};