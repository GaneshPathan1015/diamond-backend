<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index(Request $request) {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id ?? null,
            'session_id' => $request->session()->getId(),
        ]);

        return response()->json($cart->items()->with(['ring', 'diamond'])->get());
    }

    public function add(Request $request) {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id ?? null,
            'session_id' => $request->session()->getId(),
        ]);

        $item = $cart->items()->create([
            'type' => $request->type,
            'ring_id' => $request->ring_id ?? null,
            'diamond_id' => $request->diamond_id ?? null,
            'size' => $request->size ?? null,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
            'meta' => $request->meta ?? [],
        ]);

        return response()->json($item, 201);
    }

    public function update(Request $request) {
        $item = CartItem::findOrFail($request->item_id);
        $item->update([
            'quantity' => $request->quantity,
            'size' => $request->size ?? $item->size,
        ]);
        return response()->json($item);
    }

    public function remove(Request $request) {
        $item = CartItem::findOrFail($request->item_id);
        $item->delete();
        return response()->json(['message' => 'Item removed']);
    }
}
