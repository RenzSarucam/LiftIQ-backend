<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedSmallInteger('height_cm');
            $table->float('weight_kg');
            $table->unsignedTinyInteger('age');
            $table->string('gender');
            $table->float('body_fat_percent')->nullable();
            $table->string('goal');
            $table->string('experience');
            $table->string('workout_location');
            $table->unsignedSmallInteger('available_time_minutes');
            $table->json('gym_equipment');
            $table->json('previous_injuries');
            $table->json('preferred_exercises');
            $table->json('workout_days');
            $table->json('rest_days');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
