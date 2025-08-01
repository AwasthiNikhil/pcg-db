<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'country' => 'required',
            'avatar' => 'required'
        ]);
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'coins' => 0,
            'email' => $request->email,
            'country' => $request->country,
            'avatar' => $request->avatar,
            'last_login'=> now(),
        ]);
        UserSetting::insert([
            'user_id' => $user->id,
            'master_volume' => 80,
            'music_volume' => 60,
            'sfx_volume' => 70,
            'keyboard_bindings' => json_encode([
                'move_left' => 'A',
                'move_right' => 'D',
                'jump' => 'W',
                'shoot' => 'Space',
                'place_wall' => 'E',
                'place_wall_below' => 'Q',
            ])
        ]);

        // Create token for API authentication
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Login user
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Revoke old tokens if needed
        $user->tokens()->delete();

        // Create new token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Get authenticated user info
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    // Logout (revoke tokens)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
    public function addCoin(Request $request)
    {
        $request->validate([
            'coins' => 'required|integer',
        ]);

        $user = $request->user();
        $user->coins += $request->coins;
        $user->save();

        return response()->json(['message' => 'Coins added successfully', 'coins' => $user->coins], 200);
    }
}
