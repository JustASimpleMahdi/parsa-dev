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
        Schema::table('requests', function (Blueprint $table) {
            // Drop the existing foreign key (string, not array)
            $table->dropForeign('requests_request_type_id_foreign');

            // Re-add with cascade on delete
            $table->foreign('request_type_id')
                ->references('id')
                ->on('request_types')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            // Drop the cascade foreign key
            $table->dropForeign('requests_request_type_id_foreign');

            // Re-add with restrict on delete (not update)
            $table->foreign('request_type_id')
                ->references('id')
                ->on('request_types')
                ->restrictOnDelete();
        });
    }
};
