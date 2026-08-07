<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\Profile;

class WorkoutGenerator
{
    private const GROUP_MAP = [
        'Push' => ['Chest', 'Shoulders', 'Arms'],
        'Pull' => ['Back', 'Arms'],
        'Upper' => ['Chest', 'Back', 'Shoulders', 'Arms'],
        'Lower' => ['Legs', 'Core'],
    ];

    private const CALORIES_PER_MINUTE = [
        'beginner' => 6,
        'intermediate' => 8,
        'advanced' => 10,
    ];

    private const MAX_EXERCISES = [
        'beginner' => 4,
        'intermediate' => 5,
        'advanced' => 6,
    ];

    public function exercisesForFocus(string $focus)
    {
        $groups = self::GROUP_MAP[$focus] ?? [$focus];

        return Exercise::whereIn('target_muscle', $groups)->get();
    }

    public function generateWorkoutForDay(string $day, string $focus, Profile $profile): array
    {
        if ($focus === 'Rest' || $focus === 'Cardio') {
            $exercises = $focus === 'Cardio' ? $this->exercisesForFocus('Cardio') : collect();

            return [
                'day' => $day,
                'focus' => $focus,
                'exercises' => $exercises->values(),
                'warmup_minutes' => $focus === 'Cardio' ? 5 : 0,
                'estimated_minutes' => $focus === 'Cardio' ? 30 : 0,
                'estimated_calories' => $focus === 'Cardio' ? 250 : 0,
                'difficulty' => $profile->experience,
            ];
        }

        $pool = $this->exercisesForFocus($focus);
        $maxExercises = self::MAX_EXERCISES[$profile->experience] ?? 5;
        $exercises = $pool->take($maxExercises);

        $warmupMinutes = 5;
        $workMinutes = $exercises->reduce(function ($sum, $ex) {
            $perSetSeconds = 45 + $ex->rest_seconds;

            return $sum + ($ex->sets * $perSetSeconds) / 60;
        }, 0);

        $estimatedMinutes = min($profile->available_time_minutes, (int) round($warmupMinutes + $workMinutes));
        $caloriesPerMinute = self::CALORIES_PER_MINUTE[$profile->experience] ?? 7;

        return [
            'day' => $day,
            'focus' => $focus,
            'exercises' => $exercises->values(),
            'warmup_minutes' => $warmupMinutes,
            'estimated_minutes' => $estimatedMinutes,
            'estimated_calories' => (int) round($estimatedMinutes * $caloriesPerMinute),
            'difficulty' => $profile->experience,
        ];
    }
}
