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
            $table->timestamps();

            $table->foreign('npm')->references('npm')->on('anggotas')->onDelete('cascade');
            $table->foreign('id_misi')->references('id_misi')->on('misis')->onDelete('cascade');
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
