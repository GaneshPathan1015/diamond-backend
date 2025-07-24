<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiamondVendor extends Model
{
    protected $table = 'vendor_master';
    protected $primaryKey = 'vendorid';
    public $timestamps = false;

    protected $fillable = [
        'vendor_company_name',
        'vendor_name',
        'diamond_prefix',
        'vendor_email',
        'vendor_phone',
        'vendor_cell',
        'how_hear_about_us',
        'other_manufacturer_value',
        'vendor_status',
        'auto_status',
        'price_markup_type',
        'price_markup_value',
        'fancy_price_markup_value',
        'extra_markup',
        'extra_markup_value',
        'fancy_extra_markup',
        'fancy_extra_markup_value',
        'delivery_days',
        'additional_shipping_day',
        'additional_rap_discount',
        'notification_email',
        'data_path',
        'media_path',
        'external_image',
        'external_image_path',
        'external_image_formula',
        'external_video',
        'external_video_path',
        'external_video_formula',
        'external_certificate',
        'external_certificate_path',
        'if_display_vendor_stock_no',
        'vm_diamond_type',
        'show_price',
        'duplicate_feed',
        'display_invtry_before_login',
        'vendor_product_group',
        'vendor_customer_group',
        'deleted',
        'rank',
        'buying',
        'buy_email',
        'price_grid',
        'display_certificate',
        'change_status_days',
        'diamond_size_from',
        'diamond_size_to',
        'allow_color',
        'location',
        'offer_days',
        'keep_price_same_ab',
        'cc_fee',
        'date_addded',
        'added_by',
        'date_updated',
        'update_by'
    ];
}