<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => '找不到使用者',
            ], 404);
        }

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'error' => '密碼錯誤',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => '使用者 email 重複'], 409);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'success' => true,
            'message' => '成功登出'
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'success' => true,
            'user' => Auth::user(),
            'token' => Auth::refresh(),
        ]);
    }
}
