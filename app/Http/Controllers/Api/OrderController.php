<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $userId = auth()->id(); // or fetch however you manage auth
        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
         
        $orders = Order::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);         

        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_name' => 'required|string',
            'contact_number' => 'required|string',
            'items_id' => 'required|array',
            'item_details' => 'required|json',
            'total_price' => 'required|numeric',
            'address' => 'required|json',
            'order_status' => 'required|string',
            'payment_id' => 'nullable|string',
            'payment_mode' => 'required|string',
        ]);
        $validated['order_id'] = 'ORD-' . Str::uuid();

        $order = Order::create($validated);
        return response()->json($order, 201);
    }


}
