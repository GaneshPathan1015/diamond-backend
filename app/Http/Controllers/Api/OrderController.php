<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
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
        // Custom validator
        $validator = Validator::make($request->all(), [
            'user_id'        => 'required|exists:users,id',
            'user_name'      => 'required|string',
            'contact_number' => 'required|string',
            'item_details'   => 'required|json',
            'total_price'    => 'required|numeric',
            'address'        => 'required|json',
            'order_status'   => 'required|string',
            'payment_mode'   => 'required|string',
            'payment_status' => 'required|string',
            'is_gift'        => 'nullable|boolean',
            'notes'          => 'nullable|string',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['order_id'] = 'ORD-' . Str::uuid();

        // Parse the payload
        $payload = json_decode($validated['item_details'], true)['items'] ?? [];

        // Build items_id array automatically
        $itemsId = [
            'diamond' => [],
            'jewelry' => [],
            'build'   => [],
            'combo'   => [],
        ];

        foreach ($payload as $item) {
            switch ($item['productType'] ?? null) {
                case 'diamond':
                    if (!empty($item['diamondid'])) {
                        $itemsId['diamond'][] = $item['diamondid'];
                    }
                    break;

                case 'jewelry':
                    if (!empty($item['id'])) {
                        $itemsId['jewelry'][] = $item['id'];
                    }
                    break;

                case 'build':
                    if (!empty($item['id'])) {
                        $itemsId['build'][] = [
                            'id'   => $item['id'],
                            'size' => $item['size'] ?? null, // store size along with id
                        ];
                    }
                    break;

                case 'combo':
                    $itemsId['combo'][] = [
                        'diamond_id' => $item['diamond']['diamondid'] ?? null,
                        'product_id' => $item['ring']['id'] ?? null,
                        'size'       => $item['size'] ?? null,
                    ];
                    break;
            }
        }

        // Decide product type for DB
        $nonEmptyTypes = collect($itemsId)->filter(fn ($ids) => !empty($ids))->keys();

        if ($nonEmptyTypes->isEmpty()) {
            $productType = 'empty';
        } elseif ($nonEmptyTypes->count() === 1) {
            $productType = $nonEmptyTypes->first(); // "build", "diamond", "combo", "jewelry"
        } else {
            $productType = 'multiple';
        }

        // Add both product type and items_id into validated array
        $validated['items_id']     = $itemsId;
        $validated['product_type'] = $productType;

        // Save order
        try {
            $order = Order::create($validated);
            return response()->json($order, 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
