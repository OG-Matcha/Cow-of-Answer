<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = json_decode(Redis::get('users'));

        if (!$users) {
            $users = User::select('name')->get();

            if ($users->isEmpty()) {
                return response()->json(['error' => '資料庫內沒有使用者'], 404);
            }

            Redis::setex('users', 600, json_encode($users));
        }

        return response()->json($users, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => '使用者不存在'], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => '使用者不存在'], 404);
        }

        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => '使用者不存在'], 404);
        }

        $user->delete();
        return response()->json(null, 204);
    }
}
