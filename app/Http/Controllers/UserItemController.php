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
    public function spend(Request $request)
    {
        $user = Auth::user();

        // 1. Validate the input
        $validated = $request->validate([
            'spent_items' => 'required|array|min:1',
            'spent_items.*.item_id' => 'required|integer|exists:items,id',
            'spent_items.*.quantity' => 'required|integer|min:1',
        ]);

        $spentItems = $validated['spent_items'];

        $errors = [];
        $success = [];

        foreach ($spentItems as $entry) {
            $itemId = $entry['item_id'];
            $quantity = $entry['quantity'];

            $userItem = UserItem::where('user_id', $user->id)
                ->where('item_id', $itemId)
                ->first();

            if (!$userItem) {
                $errors[] = [
                    'item_id' => $itemId,
                    'message' => 'Item not found in inventory.'
                ];
                continue;
            }

            if ($userItem->quantity < $quantity) {
                $errors[] = [
                    'item_id' => $itemId,
                    'message' => 'Not enough quantity to spend.'
                ];
                continue;
            }

            // Deduct the quantity
            $userItem->quantity -= $quantity;
            if ($userItem->quantity <= 0) {gemini
                $userItem->delete(); // remove record if empty
            } else {
                $userItem->save();
            }

            $success[] = [
                'item_id' => $itemId,
                'spent' => $quantity
            ];
        }

        // 2. Handle response
        if (!empty($errors)) {
            return response()->json([
                'message' => 'Some items could not be spent.',
                'success' => $success,
                'errors' => $errors
            ], 400);
        }

        return response()->json([
            'message' => 'Items spent successfully.',
            'spent' => $success
        ], 200);
    }
}
