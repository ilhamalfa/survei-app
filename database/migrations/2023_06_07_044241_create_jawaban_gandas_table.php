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
        Schema::create('jawaban_gandas', function (Blueprint $table) {
            $table->id();
            $table->string('jawaban');
            $table->float('bobot');
            $table->foreignId('jawaban_id')->constrained('jawabans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_gandas');
    }
};
