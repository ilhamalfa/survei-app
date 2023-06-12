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
        Schema::create('surveis', function (Blueprint $table) {
            $table->id();
            $table->text('kritik_saran');
            $table->date('tanggal');
            $table->float('nilai')->nullable();
            $table->foreignId('responden_id')->constrained('respondens');
            $table->foreignId('unit_id')->constrained('units');
            $table->foreignId('layanan_id')->constrained('layanans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveis');
    }
};
