<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserItem;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class UserItemController extends Controller
{
    // List current user's inventory with item details
    public function index()
    {
        $items = UserItem::with('item')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($items);
    }

    // Add item to inventory or increase quantity
    public function addItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);
        $userId = Auth::id();
        $itemId = $request->item_id;

        $userItem = UserItem::where('user_id', $userId)
            ->where('item_id', $itemId)
            ->first();

        if ($userItem) {
            $userItem->quantity += $quantity;
            $userItem->save();
        } else {
            UserItem::create([
                'user_id' => $userId,
                'item_id' => $itemId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json(['message' => 'Item added to inventory']);
    }

    // Remove or decrease quantity of an item
    public function removeItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:user_items,item_id',
            'quantity' => 'integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);
        $userId = Auth::id();
        $itemId = $request->item_id;

        $userItem = UserItem::where('user_id', $userId)
            ->where('item_id', $itemId)
            ->first();

        if (!$userItem) {
            return response()->json(['message' => 'Item not found in inventory'], 404);
        }

        if ($userItem->quantity <= $quantity) {
            // Remove record completely if quantity is zero or less
            $userItem->delete();
        } else {
            $userItem->quantity -= $quantity;
            $userItem->save();
        }

        return response()->json(['message' => 'Item quantity updated']);
    }
}
