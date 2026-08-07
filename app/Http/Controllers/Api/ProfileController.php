<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user()->profile);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'height_cm' => ['required', 'integer', 'min:0'],
            'weight_kg' => ['required', 'numeric', 'min:0'],
            'age' => ['required', 'integer', 'min:0'],
            'gender' => ['required', 'in:male,female,other'],
            'body_fat_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'goal' => ['required', 'in:gain_muscle,lose_fat,body_recomposition,strength,powerlifting,athletic,maintain'],
            'experience' => ['required', 'in:beginner,intermediate,advanced'],
            'workout_location' => ['required', 'in:gym,home'],
            'available_time_minutes' => ['required', 'integer', 'min:0'],
            'gym_equipment' => ['array'],
            'previous_injuries' => ['array'],
            'preferred_exercises' => ['array'],
            'workout_days' => ['required', 'array', 'min:1'],
            'rest_days' => ['array'],
        ]);

        $profile = $request->user()->profile()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $data
        );

        return response()->json($profile);
    }
}
