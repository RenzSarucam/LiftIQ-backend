<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutAssignment extends Model
{
    protected $fillable = ['user_id', 'day', 'focus'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
