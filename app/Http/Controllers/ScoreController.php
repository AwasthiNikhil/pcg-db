<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    // Submit new score
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|integer|min:1',
            'score' => 'required|integer|min:0',
        ]);

        $score = Score::create([
            'user_id' => Auth::id(),
            'level' => $request->level,
            'score' => $request->score,
        ]);

        return response()->json([
            'message' => 'Score submitted successfully.',
            'data' => $score,
        ], 201);
    }

    // Get scores for authenticated user
    public function index()
    {
        $scores = Score::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return response()->json($scores);
    }

    // Get leaderboard with sum of scores for each player
    public function leaderboard()
    {
        // Fetch all scores and group by user_id, then sum the scores for each player
        $topScores = Score::with('user')
            ->get()
            ->groupBy('user_id')
            ->map(function ($scores) {
                return [
                    'user' => $scores->first()->user, // Get the first user details (same for all scores of a user)
                    'total_score' => $scores->sum('score') // Sum the scores for this user
                ];
            })
            ->sortByDesc('total_score') // Sort by total score in descending order
            ->values(); // Re-index array to reset keys

        return response()->json($topScores);
    }
}
