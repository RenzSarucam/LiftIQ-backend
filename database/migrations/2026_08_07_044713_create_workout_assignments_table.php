<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('day');
            $table->string('focus');
            $table->timestamps();
            $table->unique(['user_id', 'day']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_assignments');
    }
};
