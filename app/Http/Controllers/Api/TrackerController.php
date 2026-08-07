<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TrackerController extends Controller
{
    public function water(Request $request)
    {
        $log = $request->user()->waterLogs()->firstOrCreate(
            ['date' => Carbon::today()->toDateString()],
            ['liters' => 0, 'goal_liters' => 3]
        );

        return response()->json($log);
    }

    public function addWater(Request $request)
    {
        $data = $request->validate(['amount' => ['required', 'numeric']]);

        $log = $request->user()->waterLogs()->firstOrCreate(
            ['date' => Carbon::today()->toDateString()],
            ['liters' => 0, 'goal_liters' => 3]
        );

        $log->update(['liters' => max(0, round($log->liters + $data['amount'], 1))]);

        return response()->json($log);
    }

    public function resetWater(Request $request)
    {
        $log = $request->user()->waterLogs()->firstOrCreate(
            ['date' => Carbon::today()->toDateString()],
            ['liters' => 0, 'goal_liters' => 3]
        );

        $log->update(['liters' => 0]);

        return response()->json($log);
    }

    public function weightEntries(Request $request)
    {
        return response()->json($request->user()->weightEntries()->orderBy('date')->get());
    }

    public function logWeight(Request $request)
    {
        $data = $request->validate(['weight_kg' => ['required', 'numeric', 'min:0']]);

        $entry = $request->user()->weightEntries()->updateOrCreate(
            ['date' => Carbon::today()->toDateString()],
            ['weight_kg' => $data['weight_kg']]
        );

        return response()->json($entry, 201);
    }

    public function measurements(Request $request)
    {
        return response()->json($request->user()->bodyMeasurements()->orderBy('date')->get());
    }

    public function logMeasurement(Request $request)
    {
        $data = $request->validate([
            'chest_cm' => ['nullable', 'numeric', 'min:0'],
            'arms_cm' => ['nullable', 'numeric', 'min:0'],
            'waist_cm' => ['nullable', 'numeric', 'min:0'],
            'body_fat_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $entry = $request->user()->bodyMeasurements()->create([
            ...$data,
            'date' => Carbon::today()->toDateString(),
        ]);

        return response()->json($entry, 201);
    }
}
