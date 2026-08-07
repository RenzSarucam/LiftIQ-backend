<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WorkoutGenerator;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function assignments(Request $request)
    {
        return response()->json($request->user()->workoutAssignments);
    }

    public function assign(Request $request)
    {
        $data = $request->validate([
            'day' => ['required', 'string'],
            'focus' => ['required', 'string'],
        ]);

        $assignment = $request->user()->workoutAssignments()->updateOrCreate(
            ['day' => $data['day']],
            ['focus' => $data['focus']]
        );

        return response()->json($assignment);
    }

    public function generate(Request $request, WorkoutGenerator $generator)
    {
        $data = $request->validate([
            'day' => ['required', 'string'],
            'focus' => ['required', 'string'],
        ]);

        $profile = $request->user()->profile;

        if (! $profile) {
            return response()->json(['message' => 'Complete onboarding first.'], 422);
        }

        $workout = $generator->generateWorkoutForDay($data['day'], $data['focus'], $profile);

        return response()->json($workout);
    }
}
