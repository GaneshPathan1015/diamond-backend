<?php

namespace App\Http\Controllers\DiamondMaster;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\DiamondMaster;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.DiamondMaster.Orders.index');
    }

    public function fetch(Request $request)
    {
        $orders = Order::query();
        
        $total = $orders->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search.value');
        
        if ($search) {
            $orders->where(function($query) use ($search) {
                $query->where('order_id', 'like', "%{$search}%")
                      ->orWhere('user_name', 'like', "%{$search}%")
                      ->orWhere('contact_number', 'like', "%{$search}%");
            });
        }
        
        $filtered = $orders->skip($start)
                           ->take($limit)
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $search ? $orders->count() : $total,
            'data' => $filtered
        ]);
    }
    
    public function show(Order $order)
    {
        $diamondIds = [];
        $jewelryIds = [];
        
        $itemDetails = json_decode($order->item_details, true);
        
        if (isset($itemDetails['diamond'])) {
            foreach ($itemDetails['diamond'] as $diamond) {
                if (isset($diamond['id'])) {
                    $diamondIds[] = $diamond['id'];
                }
            }
        }
        
        if (isset($itemDetails['jewelry'])) {
            foreach ($itemDetails['jewelry'] as $jewelry) {
                if (isset($jewelry['id'])) {
                    $jewelryIds[] = $jewelry['id'];
                }
            }
        }
    

        $diamondNames = DiamondMaster::whereIn('diamondid', $diamondIds)
                ->pluck('diamond_type', 'diamondid')
                ->toArray();
        $jewelryNames = Product::whereIn('products_id', $jewelryIds)->pluck('products_name', 'products_id')->toArray();
    
        return view('admin.DiamondMaster.Orders.invoice', compact('order', 'diamondNames', 'jewelryNames'));
    }

    public function downloadInvoice(Order $order)
    {
        $pdf = Pdf::loadView('admin.DiamondMaster.Orders.invoice', compact('order'));
        return $pdf->download("Invoice-{$order->order_id}.pdf");
    }

    public function sendInvoice(Request $request, Order $order)
    {
        try {
            $to = $request->query('to', 'user');
            $email = $to === 'admin' 
                ? config('mail.from.address') 
                : ($order->user->email ?? optional($order->address)['email'] ?? null);

            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid email found'
                ], 400);
            }

            $pdf = Pdf::loadView('admin.DiamondMaster.Orders.invoice', compact('order'));
            $pdfPath = 'invoices/' . $order->order_id . '.pdf';
            Storage::disk('s3')->put($pdfPath, $pdf->output());
            $pdfUrl = Storage::disk('s3')->url($pdfPath);

            Mail::send([], [], function ($message) use ($order, $email, $pdfUrl) {
                $message->to($email)
                        ->subject("Invoice - {$order->order_id}")
                        ->html(view('admin.DiamondMaster.emails.email_template_invoice', [
                            'order' => $order,
                            'downloadUrl' => $pdfUrl
                        ])->render());
            });

            return response()->json([
                'success' => true,
                'message' => "Invoice sent to " . ($to === 'admin' ? 'admin' : 'customer')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Invoice error: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send invoice'
            ], 500);
        }
    }
    
    public function changeStatus(Request $request, Order $order)
    {
        $validTransitions = [
            'pending' => ['confirmed', 'cancelled'],
            'confirmed' => ['shipped', 'cancelled'],
            'shipped' => ['delivered', 'cancelled'],
            'delivered' => ['returned', 'cancelled'],
            'cancelled' => [],
            'returned' => [],
        ];

        $currentStatus = $order->order_status;
        $newStatus = $request->order_status;

        if (!in_array($newStatus, $validTransitions[$currentStatus])) {
            return response()->json([
                'success' => false,
                'message' => "Invalid status transition"
            ], 400);
        }

        $order->update(['order_status' => $newStatus]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated',
            'new_status' => $newStatus
        ]);
    }

        public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_name' => 'required|string',
            'contact_number' => 'required|string',
            'items_id' => 'required|array',
            'item_details' => 'required|array',
            'total_price' => 'required|numeric',
            'shipping_cost' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'coupon_code' => 'nullable|string',
            'address' => 'required|array',
            'payment_mode' => 'required|string',
            'payment_status' => 'required|string',
            'order_status' => 'required|string',
            'delivery_date' => 'nullable|date',
        ]);

        $hasDiamond = false;
        $hasJewelry = false;
        $processedItems = [];
        $validItemsId = [];

        foreach ($data['item_details'] as $key => $item) {
            if (!is_numeric($key)) {
                $itemData = $item;
                $itemKey = $key;
            } else {
                $itemData = $item;
                $itemKey = $key;
            }

            $type = $itemData['type'] ?? 'diamond';
            if ($type === 'diamond') $hasDiamond = true;
            if ($type === 'jewelry') $hasJewelry = true;
            
            $processedItem = [
                'name' => $itemData['name'] 
                    ?? $itemData['diamond_name'] 
                    ?? $itemData['jewelry_name'] 
                    ?? ($itemData['title'] ?? 'Product'),
                'type' => $type,
                'quantity' => $itemData['quantity'] ?? 1,
                'price' => $itemData['price'] ?? 0,
            ];

            if ($type === 'diamond') {
                $processedItem['certificate_number'] = $itemData['certificate_number'] 
                    ?? $itemData['certificate_no'] 
                    ?? null;
                    
                if (is_numeric($itemKey) && $itemKey != 0) {
                    $validItemsId[] = $itemKey;
                }
            }

            if ($type === 'jewelry') {
                $processedItem['metal_type'] = $itemData['metal_type'] 
                    ?? $itemData['metal'] 
                    ?? null;
                $processedItem['metal_color'] = $itemData['metal_color'] 
                    ?? $itemData['color'] 
                    ?? null;
                $processedItem['metal_purity'] = $itemData['metal_purity'] 
                    ?? $itemData['purity'] 
                    ?? null;
                $processedItem['size'] = $itemData['size'] 
                    ?? $itemData['ring_size'] 
                    ?? null;
                    
                if (isset($data['items_id'][$key]) && $data['items_id'][$key] !== null) {
                    $validItemsId[] = $data['items_id'][$key];
                }
            }

            $processedItems[] = $processedItem;
        }

        $data['product_type'] = ($hasDiamond && $hasJewelry) ? 'mixed' : 
                               ($hasJewelry ? 'jewelry' : 'diamond');

        $data['items_id'] = !empty($validItemsId) ? $validItemsId : null;
        $data['item_details'] = $processedItems;
        $data['order_id'] = 'ORD-' . now()->format('Ymd') . '-' . Str::random(4);

        Order::create($data);

        return redirect()->route('orders.index')
                         ->with('success', 'Order created');
    }
}