<?php

namespace App\Http\Controllers;

use App\Models\UserAchievement;
use Illuminate\Http\Request;

class UserAchievementController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'achievement_id' => 'required|integer|exists:achievements,id',
        ]);

        if (UserAchievement::where('user_id', $request->user_id)
            ->where('achievement_id', $request->achievement_id)
            ->exists()
        ) {
            return response()->json(['error' => '此映射已存在'], 409);
        }

        $userAchievement = UserAchievement::create($request->all());
        return response()->json($userAchievement, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_achievement_id)
    {
        $userAchievement = UserAchievement::find($user_achievement_id);

        if (!$userAchievement) {
            return response()->json(['error' => '此映射不存在'], 404);
        }

        $userAchievement->delete();
        return response()->json(null, 204);
    }
}
