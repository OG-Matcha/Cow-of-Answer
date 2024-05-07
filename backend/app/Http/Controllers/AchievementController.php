<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::select('id', 'name', 'image', 'star')->get();
        return response()->json($achievements, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $achievement = Achievement::create($request->all());
        return response()->json($achievement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        return response()->json($achievement, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $achievement)
    {
        $achievement->update($request->all());
        return response()->json($achievement, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json(null, 204);
    }
}
