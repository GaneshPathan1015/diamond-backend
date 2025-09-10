<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {
    protected $fillable = [
        'cart_id', 'type', 'product_id', 'diamondid',
        'size', 'price', 'quantity', 'meta'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function ring() {
        return $this->belongsTo(Ring::class);
    }

    public function diamond() {
        return $this->belongsTo(Diamond::class);
    }
}
