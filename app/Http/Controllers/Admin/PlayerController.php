<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function getAllPlayers(Request $request)
    {
        $query = User::with('scores'); // Start with the base query

        // Apply search filter if provided
        if ($request->has('search') && $request->search) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        // Apply status filter if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Fetch the players with total scores
        $players = $query->get()->map(function ($player) {
            $totalScore = $player->scores->sum('score');
            return [
                'id' => $player->id,
                'username' => $player->username,
                // 'email' => $player->email,
                'total_score' => $totalScore,
                'last_login' => $player->last_login,
                'status' => $player->status,
            ];
        });

        return response()->json($players);
    }

    public function toggleBanPlayer(User $player, $action)
    {
        // Check if the action is valid
        if (!in_array($action, ['ban', 'unban'])) {
            return response()->json(['message' => 'Invalid action'], 400);
        }

        // Toggle the status based on the action
        if ($action === 'ban') {
            $player->status = 'banned';
            $message = 'Player banned successfully.';
        } else {
            $player->status = 'active';
            $message = 'Player unbanned successfully.';
        }

        $player->save(); // Save the new status

        return response()->json(['message' => $message]);
    }
}
