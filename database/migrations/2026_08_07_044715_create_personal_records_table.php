<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('exercise_name');
            $table->float('weight_kg');
            $table->unsignedSmallInteger('reps');
            $table->date('date');
            $table->timestamps();
            $table->unique(['user_id', 'exercise_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_records');
    }
};
