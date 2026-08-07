<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'sets', 'reps', 'rest_seconds', 'target_muscle',
        'secondary_muscles', 'equipment', 'difficulty', 'common_mistakes', 'tips',
    ];

    protected $casts = [
        'secondary_muscles' => 'array',
        'common_mistakes' => 'array',
        'tips' => 'array',
    ];
}
