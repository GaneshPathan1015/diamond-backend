<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $table = 'categories';
    public $incrementing = true; 

    protected $fillable = [
        'parent_id',  
        'category_name',
        'category_alias',
        'category_description',
        'is_display_front',
        'category_image',
        'category_header_banner',
        'category_status',
        'seo_url',
        'category_meta_title',
        'category_meta_description',
        'category_meta_keyword',
        'category_h1_tag',
        'sort_order',
        'deleted',
        'category_date_added',
        'category_date_modified',
        'added_by',
        'updated_by'
    ];

    protected $casts = [
        'category_date_added' => 'datetime',
        'category_date_modified' => 'datetime',
        'is_display_front' => 'boolean',
        'category_status' => 'boolean',
        'deleted' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }
    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
    
    public function styleCategories()
    {
        return $this->hasMany(ProductStyleCategory::class, 'psc_category_id', 'category_id');
    }
}