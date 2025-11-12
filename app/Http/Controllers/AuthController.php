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
            'last_login' => now(),
        ]);
        UserSetting::insert([
            'user_id' => $user->id,
            'master_volume' => 80,
            'music_volume' => 60,
            'sfx_volume' => 70,
            'keyboard_bindings' => json_encode(
                ['jump' => 87, 'shoot' => 32, 'move_left' => 65, 'move_right' => 68, 'place_wall' => 69, 'place_wall_below' => 83]
            )

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

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['The provided credentials are incorrect.'],
            ], 401);
        }
        if ($user && $user->status !== 'active') {
            return response()->json([
                'message' => ['User is banned. Contact admin.'],
            ], 401);
        }

        $user->last_login = now();
        $user->save();
        // Revoke old tokens if needed
        $user->tokens()->delete();

        // Create new token
        $token = $user->createToken('api-token')->plainTextToken;

        $user->avatar = $user->avatar . '.png';
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Get authenticated user info
    public function user(Request $request)
    {
        $request->user()->last_login = now();
        $request->user()->save();
        $request->user()->avatar = $request->user()->avatar . '.png';
        return response()->json($request->user());
    }

    // Logout (revoke tokens)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
    // add coin to player
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
    // add coin to player
    public function subCoin(Request $request)
    {
        $request->validate([
            'coins' => 'required|integer',
        ]); 

        $user = $request->user();
        $user->coins -= $request->coins;
        $user->save();

        return response()->json(['message' => 'Coins removed successfully', 'coins' => $user->coins], 200);
    }

    // change user password
    public function changePassword(Request $request)
    {

        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:6|different:old_password',
            ]);

            $user = $request->user();
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => 'The current password is incorrect.'
                ],422);
            }
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['message' => 'Password changed successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Error password.'], 422);
        }
    }
}
