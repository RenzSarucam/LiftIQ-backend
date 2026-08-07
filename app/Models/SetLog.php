<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SetLog extends Model
{
    protected $fillable = ['exercise_log_id', 'set_number', 'weight_kg', 'reps', 'completed'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function exerciseLog(): BelongsTo
    {
        return $this->belongsTo(ExerciseLog::class);
    }
}
