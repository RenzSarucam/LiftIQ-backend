<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $exercises = [
            ['id' => 'bench-press', 'name' => 'Bench Press', 'sets' => 4, 'reps' => '10', 'rest_seconds' => 90, 'target_muscle' => 'Chest', 'secondary_muscles' => ['Arms', 'Shoulders'], 'equipment' => 'Barbell', 'difficulty' => 'intermediate', 'common_mistakes' => ['Flaring elbows too wide', 'Bouncing the bar off the chest'], 'tips' => ['Keep elbows at ~45°', 'Drive through your feet']],
            ['id' => 'incline-dumbbell-press', 'name' => 'Incline Dumbbell Press', 'sets' => 3, 'reps' => '12', 'rest_seconds' => 75, 'target_muscle' => 'Chest', 'secondary_muscles' => ['Shoulders'], 'equipment' => 'Dumbbells', 'difficulty' => 'beginner', 'common_mistakes' => ['Setting the bench too steep'], 'tips' => ['30-45° incline targets upper chest best']],
            ['id' => 'machine-chest-press', 'name' => 'Machine Chest Press', 'sets' => 3, 'reps' => '10', 'rest_seconds' => 75, 'target_muscle' => 'Chest', 'equipment' => 'Machine', 'difficulty' => 'beginner', 'tips' => ['Great substitute when the bench press is unavailable']],
            ['id' => 'cable-fly', 'name' => 'Cable Fly', 'sets' => 3, 'reps' => '15', 'rest_seconds' => 60, 'target_muscle' => 'Chest', 'equipment' => 'Cables', 'difficulty' => 'intermediate'],
            ['id' => 'push-ups', 'name' => 'Push Ups', 'sets' => 3, 'reps' => 'to failure', 'rest_seconds' => 60, 'target_muscle' => 'Chest', 'equipment' => 'Bodyweight', 'difficulty' => 'beginner', 'tips' => ['Great substitute when dumbbells are unavailable']],
            ['id' => 'deadlift', 'name' => 'Deadlift', 'sets' => 4, 'reps' => '6', 'rest_seconds' => 120, 'target_muscle' => 'Back', 'secondary_muscles' => ['Legs'], 'equipment' => 'Barbell', 'difficulty' => 'advanced', 'common_mistakes' => ['Rounding the lower back'], 'tips' => ['Keep the bar close to your shins']],
            ['id' => 'pull-up', 'name' => 'Pull Up', 'sets' => 4, 'reps' => '8', 'rest_seconds' => 90, 'target_muscle' => 'Back', 'secondary_muscles' => ['Arms'], 'equipment' => 'Bodyweight', 'difficulty' => 'intermediate'],
            ['id' => 'lat-pulldown', 'name' => 'Lat Pulldown', 'sets' => 3, 'reps' => '12', 'rest_seconds' => 75, 'target_muscle' => 'Back', 'equipment' => 'Cables', 'difficulty' => 'beginner'],
            ['id' => 'barbell-row', 'name' => 'Barbell Row', 'sets' => 4, 'reps' => '10', 'rest_seconds' => 90, 'target_muscle' => 'Back', 'equipment' => 'Barbell', 'difficulty' => 'intermediate'],
            ['id' => 'squat', 'name' => 'Squat', 'sets' => 4, 'reps' => '8', 'rest_seconds' => 120, 'target_muscle' => 'Legs', 'equipment' => 'Barbell', 'difficulty' => 'intermediate', 'common_mistakes' => ['Knees caving inward'], 'tips' => ['Keep your chest up, knees tracking over toes']],
            ['id' => 'leg-press', 'name' => 'Leg Press', 'sets' => 3, 'reps' => '12', 'rest_seconds' => 90, 'target_muscle' => 'Legs', 'equipment' => 'Machine', 'difficulty' => 'beginner'],
            ['id' => 'lunges', 'name' => 'Lunges', 'sets' => 3, 'reps' => '12 each leg', 'rest_seconds' => 60, 'target_muscle' => 'Legs', 'equipment' => 'Dumbbells', 'difficulty' => 'beginner'],
            ['id' => 'overhead-press', 'name' => 'Overhead Press', 'sets' => 4, 'reps' => '8', 'rest_seconds' => 90, 'target_muscle' => 'Shoulders', 'equipment' => 'Barbell', 'difficulty' => 'intermediate'],
            ['id' => 'lateral-raise', 'name' => 'Lateral Raises', 'sets' => 3, 'reps' => '15', 'rest_seconds' => 60, 'target_muscle' => 'Shoulders', 'equipment' => 'Dumbbells', 'difficulty' => 'beginner'],
            ['id' => 'bicep-curl', 'name' => 'Bicep Curl', 'sets' => 3, 'reps' => '12', 'rest_seconds' => 60, 'target_muscle' => 'Arms', 'equipment' => 'Dumbbells', 'difficulty' => 'beginner'],
            ['id' => 'tricep-pushdown', 'name' => 'Tricep Pushdown', 'sets' => 3, 'reps' => '12', 'rest_seconds' => 60, 'target_muscle' => 'Arms', 'equipment' => 'Cables', 'difficulty' => 'beginner'],
            ['id' => 'plank', 'name' => 'Plank', 'sets' => 3, 'reps' => '45 sec', 'rest_seconds' => 45, 'target_muscle' => 'Core', 'equipment' => 'Bodyweight', 'difficulty' => 'beginner'],
            ['id' => 'hanging-leg-raise', 'name' => 'Hanging Leg Raise', 'sets' => 3, 'reps' => '12', 'rest_seconds' => 60, 'target_muscle' => 'Core', 'equipment' => 'Bodyweight', 'difficulty' => 'intermediate'],
            ['id' => 'treadmill-intervals', 'name' => 'Treadmill Intervals', 'sets' => 6, 'reps' => '1 min on / 1 min off', 'rest_seconds' => 60, 'target_muscle' => 'Cardio', 'equipment' => 'Treadmill', 'difficulty' => 'beginner'],
            ['id' => 'jump-rope', 'name' => 'Jump Rope', 'sets' => 5, 'reps' => '2 min', 'rest_seconds' => 45, 'target_muscle' => 'Cardio', 'equipment' => 'Jump Rope', 'difficulty' => 'beginner'],
        ];

        foreach ($exercises as $exercise) {
            Exercise::updateOrCreate(['id' => $exercise['id']], $exercise);
        }
    }
}
