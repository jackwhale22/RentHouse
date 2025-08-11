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
        Schema::table('kos_photos', function (Blueprint $table) {
            // Rename path column to foto_path 
            $table->renameColumn('path', 'foto_path');
            // Drop filename column since we're not using it
            $table->dropColumn('filename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kos_photos', function (Blueprint $table) {
            $table->renameColumn('foto_path', 'path');
            $table->string('filename');
        });
    }
};
