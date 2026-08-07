<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExerciseLog extends Model
{
    protected $fillable = ['workout_log_id', 'exercise_id', 'exercise_name', 'order'];

    public function workoutLog(): BelongsTo
    {
        return $this->belongsTo(WorkoutLog::class);
    }

    public function setLogs(): HasMany
    {
        return $this->hasMany(SetLog::class);
    }
}
