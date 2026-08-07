<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->unsignedTinyInteger('sets');
            $table->string('reps');
            $table->unsignedSmallInteger('rest_seconds');
            $table->string('target_muscle');
            $table->json('secondary_muscles')->nullable();
            $table->string('equipment')->nullable();
            $table->string('difficulty')->nullable();
            $table->json('common_mistakes')->nullable();
            $table->json('tips')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
