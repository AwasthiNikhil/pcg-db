<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function show()
    {
        $settings = UserSetting::where('user_id', Auth::id())->first();

        if (!$settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        return response()->json($settings);
    }

    public function update(Request $request)
    {

        $user = $request->user();

        if ($user) {
            $request->validate([
                'master_volume' => 'nullable|integer|min:0|max:100',
                'music_volume' => 'nullable|integer|min:0|max:100',
                'sfx_volume' => 'nullable|integer|min:0|max:100',
                'keyboard_bindings' => 'array',
            ]);

            UserSetting::where('id', $user->id)->update([
                'master_volume' => $request->master_volume ?? $request->master_volume,
                'music_volume' => $request->music_volume ?? $request->music_volume,
                'sfx_volume' => $request->sfx_volume ?? $request->sfx_volume,
                'keyboard_bindings' => $request->keyboard_bindings,
            ]);

            return response()->json([
                'message' => 'Settings updated successfully.',
                'data' => $request->only([
                    'master_volume',
                    'music_volume',
                    'sfx_volume',
                    'keyboard_bindings'
                ])
            ]);
        } else {
            return response()->json([
                'message' => 'No user found'
            ]);
        }
    }
}
