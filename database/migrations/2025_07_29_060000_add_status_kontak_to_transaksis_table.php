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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->enum('status_kontak', ['pending', 'contacted', 'closed'])->default('pending')->after('status_transaksi');
            $table->text('balasan_pemilik')->nullable()->after('catatan');
            $table->timestamp('tanggal_balasan')->nullable()->after('balasan_pemilik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['status_kontak', 'balasan_pemilik', 'tanggal_balasan']);
        });
    }
};

