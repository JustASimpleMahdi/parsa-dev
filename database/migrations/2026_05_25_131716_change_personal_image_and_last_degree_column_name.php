<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            $table->renameColumn('personal_image', 'personal_image_file_id');
            $table->renameColumn('last_degree', 'last_degree_file_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            $table->renameColumn('personal_image_file_id', 'personal_image');
            $table->renameColumn('last_degree_file_id', 'last_degree');
        });
    }
};
