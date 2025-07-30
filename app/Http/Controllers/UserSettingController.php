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
        $request->validate([
            'master_volume' => 'nullable|integer|min:0|max:100',
            'music_volume' => 'nullable|integer|min:0|max:100',
            'sfx_volume' => 'nullable|integer|min:0|max:100',
            'keyboard_bindings' => 'nullable|array',
        ]);

        $settings = UserSetting::firstOrCreate(
            ['user_id' => Auth::id()],
            ['master_volume' => 100, 'music_volume' => 100, 'sfx_volume' => 100]
        );

        $settings->update([
            'master_volume' => $request->master_volume ?? $settings->master_volume,
            'music_volume' => $request->music_volume ?? $settings->music_volume,
            'sfx_volume' => $request->sfx_volume ?? $settings->sfx_volume,
            'keyboard_bindings' => $request->keyboard_bindings ?? $settings->keyboard_bindings,
        ]);

        return response()->json([
            'message' => 'Settings updated successfully.',
            'data' => $settings,
        ]);
    }
}
