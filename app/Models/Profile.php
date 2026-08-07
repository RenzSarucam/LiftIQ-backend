<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'height_cm', 'weight_kg', 'age', 'gender', 'body_fat_percent',
        'goal', 'experience', 'workout_location', 'available_time_minutes',
        'gym_equipment', 'previous_injuries', 'preferred_exercises', 'workout_days', 'rest_days',
    ];

    protected $casts = [
        'gym_equipment' => 'array',
        'previous_injuries' => 'array',
        'preferred_exercises' => 'array',
        'workout_days' => 'array',
        'rest_days' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
