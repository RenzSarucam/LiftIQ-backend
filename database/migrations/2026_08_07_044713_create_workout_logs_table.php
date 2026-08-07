<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('day');
            $table->string('focus');
            $table->unsignedSmallInteger('duration_minutes');
            $table->float('volume_kg');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_logs');
    }
};
