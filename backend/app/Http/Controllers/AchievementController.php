<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::all();
        return response()->json($achievements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAchievementRequest $request)
    {
        $achievement = Achievement::create($request->all());
        return response()->json($achievement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        return response()->json($achievement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $achievement->update($request->all());
        return response()->json($achievement);
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
