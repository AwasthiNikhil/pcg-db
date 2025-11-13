<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    public function getStats()
    {
        $totalPlayers = User::count();
        $onlinePlayers = User::where('last_login', '>', now()->subMinutes(5))->count();

        return response()->json([
            'totalPlayers' => $totalPlayers,
            'onlinePlayers' => $onlinePlayers,
        ]);
    }
}
