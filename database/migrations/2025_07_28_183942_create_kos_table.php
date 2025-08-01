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
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kos');
            $table->string('lokasi');
            $table->decimal('harga', 10, 2);
            $table->text('fasilitas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status_ketersediaan', ['tersedia', 'tidak_tersedia'])->default('tersedia');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // pemilik
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
