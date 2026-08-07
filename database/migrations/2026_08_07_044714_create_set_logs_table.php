<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('set_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_log_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('set_number');
            $table->float('weight_kg')->default(0);
            $table->unsignedSmallInteger('reps')->default(0);
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('set_logs');
    }
};
