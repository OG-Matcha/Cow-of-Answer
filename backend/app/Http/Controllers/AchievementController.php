<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = json_decode(Redis::get('achievements'));

        if (!$achievements) {
            $achievements = Achievement::select('id', 'name', 'image', 'star')->get();

            if ($achievements->isEmpty()) {
                return response()->json(['error' => '資料庫內沒有成就'], 404);
            }

            Redis::setex('achievements', 600, json_encode($achievements));
        }

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
    public function show($achievement_id)
    {
        $achievement = Achievement::select('description')->find($achievement_id);

        if (!$achievement) {
            return response()->json(['error' => '成就不存在'], 404);
        }

        return response()->json($achievement, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $achievement_id)
    {
        $achievement = Achievement::find($achievement_id);

        if (!$achievement) {
            return response()->json(['error' => '成就不存在'], 404);
        }

        $achievement->update($request->all());
        return response()->json($achievement, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($achievement_id)
    {
        $achievement = Achievement::find($achievement_id);

        if (!$achievement) {
            return response()->json(['error' => '成就不存在'], 404);
        }

        $achievement->delete();
        return response()->json(null, 204);
    }
}
