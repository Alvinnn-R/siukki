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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id('id_aktivitas');
            $table->string('npm', 15);
            $table->unsignedBigInteger('id_misi');
            $table->string('bukti_aktifitas')->nullable();
            $table->date('tanggal');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->integer('xp_diperoleh')->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('npm')->references('npm')->on('anggotas')->onDelete('cascade');
            $table->foreign('id_misi')->references('id_misi')->on('misis')->onDelete('cascade');

            // Index untuk performance
            $table->index(['npm', 'tanggal']);
            $table->index(['id_misi', 'tanggal']);
            $table->index('status');

            // Unique constraint untuk mencegah duplikasi misi harian di hari yang sama
            $table->unique(['npm', 'id_misi', 'tanggal'], 'unique_daily_mission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
