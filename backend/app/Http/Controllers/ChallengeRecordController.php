<?php

namespace App\Http\Controllers;

use App\Models\ChallengeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChallengeRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function rankList($challenge_number)
    {
        $records = json_decode(Redis::get("rank_{$challenge_number}"));

        if (!$records) {
            $records = ChallengeRecord::where('challenge_number', $challenge_number)
                ->with('user')
                ->orderBy('best_time', 'asc')
                ->take(10)
                ->get()
                ->map(function ($record) {
                    return [
                        'user_name' => $record->user->name,
                        'best_time' => $record->best_time,
                    ];
                });

            Redis::setex("rank_{$challenge_number}", 600, json_encode($records));
        }

        return response()->json($records, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'challenge_number' => 'required|integer',
            'best_time' => 'required|integer',
        ]);

        $record = ChallengeRecord::where('user_id', $request->user_id)
            ->where('challenge_number', $request->challenge_number)
            ->first();

        if ($record) {
            if ($request->best_time < $record->best_time) {
                $record->best_time = $request->best_time;
                $record->save();
            }
        } else {
            $record = ChallengeRecord::create($request->all());
        }

        return response()->json($record, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($challengeRecord_id)
    {
        $challengeRecord = ChallengeRecord::find($challengeRecord_id);

        if (!$challengeRecord) {
            return response()->json(['error' => '通關紀錄不存在'], 404);
        }

        $challengeRecord->delete();
        return response()->json(null, 204);
    }
}
