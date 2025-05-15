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
            $table->string('id_admin', 15);
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('poin')->default(0);
            $table->date('jadwal');
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('user_admins')->onDelete('cascade');
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
