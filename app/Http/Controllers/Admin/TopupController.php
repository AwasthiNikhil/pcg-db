<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    public function searchUsers(Request $request)
    {
        $query = $request->input('q');
        $users = User::where('username', 'LIKE', "%{$query}%")->limit(10)->get(['id', 'username']);
        return response()->json($users);
    }

    public function addCoins(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'coins' => 'required|integer|min:1',
        ]);

        $user = User::find($request->user_id);
        $user->coins += $request->coins;
        $user->save();

        return response()->json(['message' => 'Coins added successfully to ' . $user->username]);
    }
}