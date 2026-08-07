<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $query = Exercise::query();

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($muscle = $request->query('muscle')) {
            $query->where('target_muscle', $muscle);
        }

        return response()->json($query->orderBy('name')->get());
    }

    public function show(string $exercise)
    {
        return response()->json(Exercise::findOrFail($exercise));
    }
}
