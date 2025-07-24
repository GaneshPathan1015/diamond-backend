<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductVariation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id', 
        'carat', 
        'price', 
        'regular_price',
        'sku', 
        'images',
        'master_sku', 
        'stock', 
        'weight', 
        'shape_id', 
        'category_id', 
        'metal_color_id', 
        'vendor_id',
        'parent_category_id',
    ];
    
    protected $casts = [
        'images' => 'array',
    ];

    public function getImagesAttribute($value)
    {
        $images = is_array($value) ? $value : json_decode($value, true);

        // fallback if it's still not an array
        if (!is_array($images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset($image); // or 'storage/variation_images/' . $image if needed
        }, $images);
    }
    
    protected static function booted()
    {
        static::deleted(function ($variation) {
            // Delete associated images
            if ($variation->images) {
                foreach ($variation->images as $imagePath) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
        });
    }

    public function getImageFilenames()
    {
        $images = $this->getRawOriginal('images');

        if (is_string($images)) {
            $decoded = json_decode($images, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $images = $decoded;
            } else {
                $images = [$images];
            }
        }

        $filenames = [];
        foreach ((array)$images as $path) {
            $filenames[] = basename($path);
        }
        
        return $filenames;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'products_id');
    }

    public function shape()
    {
        return $this->belongsTo(DiamondShape::class, 'shape_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function metalColor()
    {
        return $this->belongsTo(MetalType::class, 'metal_color_id');
    }
}
