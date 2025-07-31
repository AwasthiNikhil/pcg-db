<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SkinController extends Controller
{
    public function index()
    {
        $skins = Item::where('type', 'skin')->withTrashed()->get([
            'id', 'name', 'description', 'price', 'rarity', 'image_path', 'deleted_at'
        ]);
        return response()->json($skins);
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'rarity' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $skin = Item::create([
            'name' => $data['name'],
            'type' => 'skin',
            'description' => $data['description'],
            'price' => $data['price'],
            'rarity' => $data['rarity'],
        ]);

        // Create directory
        $folderName = "skins/{$skin->id}-" . Str::slug($skin->name);
        Storage::makeDirectory($folderName);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store("skins/{$skin->id}-" . Str::slug($skin->name), 'public');
            $skin->image_path = $path;
            $skin->save();
        }

        return response()->json(['message' => 'Skin added successfully']);
    }

    public function toggleDelete(Item $skin, $action)
    {
        if ($action === 'delete') {
            $skin->delete();
            $msg = 'Skin marked as deleted';
        } elseif ($action === 'restore') {
            $skin->restore();
            $msg = 'Skin restored';
        } else {
            return response()->json(['message' => 'Invalid action'], 400);
        }
        return response()->json(['message' => $msg]);
    }
}
