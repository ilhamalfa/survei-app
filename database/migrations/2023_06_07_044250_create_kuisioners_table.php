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
        Schema::create('kuisioners', function (Blueprint $table) {
            $table->id();
            $table->float('bobot');
            $table->foreignId('soal_kuisioners_id')->constrained('soal_kuisioners');
            $table->foreignId('jawaban_id')->constrained('jawabans');
            $table->foreignId('layanan_id')->constrained('layanans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuisioners');
    }
};
