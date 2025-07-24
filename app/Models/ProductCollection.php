<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    protected $table = 'product_collections';
    public $timestamps = false;

    protected $fillable = [
        'product_category_id',
        'parent_category_id',
        'name',
        'collection_image',
        'heading',
        'description',
        'banner_image',
        'banner_video',
        'status',
        'sort_order',
        'alias',
        'display_in_menu',
        'date_added',
        'date_modified',
        'added_by',
        'updated_by',
    ];

     public function productCategory()
    {
        return $this->belongsTo(Category::class, 'product_category_id', 'category_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'category_id');
    }
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}