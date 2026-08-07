<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutLog extends Model
{
    protected $fillable = ['user_id', 'date', 'day', 'focus', 'duration_minutes', 'volume_kg'];

    protected $casts = [
        'date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseLogs(): HasMany
    {
        return $this->hasMany(ExerciseLog::class);
    }
}
