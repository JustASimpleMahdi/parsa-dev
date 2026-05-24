<?php

use App\Models\File as FileModel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->primary()->constrained()->cascadeOnDelete();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('father_name');
            $table->string('birthdate');
            $table->string('birthplace');
            $table->string('id_number');
            $table->string('national_code')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('postal_code');
            $table->foreignIdFor(FileModel::class, 'personal_image')->constrained()->restrictOnDelete();
            $table->foreignIdFor(FileModel::class, 'last_degree')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
