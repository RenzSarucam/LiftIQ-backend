<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkoutLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = $request->user()
            ->workoutLogs()
            ->with('exerciseLogs.setLogs')
            ->orderByDesc('date')
            ->get();

        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'day' => ['required', 'string'],
            'focus' => ['required', 'string'],
            'duration_minutes' => ['required', 'integer', 'min:0'],
            'volume_kg' => ['required', 'numeric', 'min:0'],
            'exercises' => ['required', 'array', 'min:1'],
            'exercises.*.exercise_id' => ['nullable', 'string'],
            'exercises.*.exercise_name' => ['required', 'string'],
            'exercises.*.sets' => ['required', 'array', 'min:1'],
            'exercises.*.sets.*.set_number' => ['required', 'integer', 'min:1'],
            'exercises.*.sets.*.weight_kg' => ['required', 'numeric', 'min:0'],
            'exercises.*.sets.*.reps' => ['required', 'integer', 'min:0'],
            'exercises.*.sets.*.completed' => ['required', 'boolean'],
        ]);

        $log = DB::transaction(function () use ($data, $request) {
            $log = $request->user()->workoutLogs()->create([
                'date' => $data['date'],
                'day' => $data['day'],
                'focus' => $data['focus'],
                'duration_minutes' => $data['duration_minutes'],
                'volume_kg' => $data['volume_kg'],
            ]);

            foreach ($data['exercises'] as $order => $exercise) {
                $exerciseLog = $log->exerciseLogs()->create([
                    'exercise_id' => $exercise['exercise_id'] ?? null,
                    'exercise_name' => $exercise['exercise_name'],
                    'order' => $order,
                ]);

                $exerciseLog->setLogs()->createMany($exercise['sets']);

                $topSet = collect($exercise['sets'])
                    ->where('completed', true)
                    ->sortByDesc('weight_kg')
                    ->first();

                if ($topSet && $topSet['weight_kg'] > 0) {
                    $existing = $request->user()->personalRecords()
                        ->where('exercise_name', $exercise['exercise_name'])
                        ->first();

                    if (! $existing || $topSet['weight_kg'] > $existing->weight_kg) {
                        $request->user()->personalRecords()->updateOrCreate(
                            ['exercise_name' => $exercise['exercise_name']],
                            [
                                'weight_kg' => $topSet['weight_kg'],
                                'reps' => $topSet['reps'],
                                'date' => $data['date'],
                            ]
                        );
                    }
                }
            }

            return $log;
        });

        return response()->json($log->load('exerciseLogs.setLogs'), 201);
    }

    public function records(Request $request)
    {
        return response()->json($request->user()->personalRecords()->orderBy('exercise_name')->get());
    }
}
