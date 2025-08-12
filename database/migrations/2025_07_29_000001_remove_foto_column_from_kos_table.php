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
        Schema::table('kos', function (Blueprint $table) {
            // Drop kolom foto karena sekarang menggunakan tabel kos_photos
            $table->dropColumn('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kos', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('status_ketersediaan');
        });
    }
};
