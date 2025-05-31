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
        Schema::create('misis', function (Blueprint $table) {
            $table->id('id_misi');
            $table->string('nama_misi');
            $table->text('deskripsi')->nullable();
            $table->integer('xp_reward')->default(0);
            $table->enum('tipe_misi', ['harian', 'mingguan', 'event'])->default('harian');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->date('jadwal');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misis');
    }
};
