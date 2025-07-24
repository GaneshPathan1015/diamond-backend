<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_master', function (Blueprint $table) {
            $table->bigIncrements('vendorid');
            $table->string('vendor_company_name', 150)->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('diamond_prefix', 150)->nullable();
            $table->string('vendor_email', 100)->nullable();
            $table->string('vendor_phone', 20)->nullable();
            $table->string('vendor_cell', 25)->nullable();
            $table->string('how_hear_about_us', 150)->nullable();
            $table->string('other_manufacturer_value', 250)->nullable();
            $table->tinyInteger('vendor_status')->nullable();
            $table->tinyInteger('auto_status')->default(1);
            $table->tinyInteger('price_markup_type')->nullable();
            $table->double('price_markup_value')->nullable();
            $table->double('fancy_price_markup_value')->nullable();
            $table->tinyInteger('extra_markup')->nullable();
            $table->double('extra_markup_value')->nullable();
            $table->tinyInteger('fancy_extra_markup')->nullable();
            $table->double('fancy_extra_markup_value')->nullable();           
            $table->string('delivery_days', 20)->nullable();
            $table->string('additional_shipping_day', 20)->default('0');
            $table->string('additional_rap_discount', 50)->nullable();
            $table->string('notification_email')->nullable();
            $table->string('data_path')->nullable();
            $table->string('media_path', 50)->nullable();
            $table->tinyInteger('external_image')->nullable();
            $table->string('external_image_path')->nullable();
            $table->text('external_image_formula')->nullable();
            $table->tinyInteger('external_video')->nullable();
            $table->string('external_video_path')->nullable();
            $table->text('external_video_formula')->nullable();
            $table->tinyInteger('external_certificate')->nullable();
            $table->string('external_certificate_path')->nullable();
            $table->tinyInteger('if_display_vendor_stock_no')->default(0);
            $table->string('vm_diamond_type', 150)->nullable();
            $table->tinyInteger('show_price')->default(1);
            $table->tinyInteger('duplicate_feed')->default(0);
            $table->tinyInteger('display_invtry_before_login')->default(1);
            $table->text('vendor_product_group')->nullable();
            $table->text('vendor_customer_group')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('rank')->default(0);
            $table->tinyInteger('buying')->default(0);
            $table->tinyInteger('buy_email')->default(0);
            $table->tinyInteger('price_grid')->default(0);
            $table->tinyInteger('display_certificate')->default(1);
            $table->string('change_status_days', 20)->default('0');
            $table->double('diamond_size_from')->default(0);
            $table->double('diamond_size_to')->default(0);
            $table->string('allow_color')->nullable();
            $table->text('location')->nullable();
            $table->string('offer_days', 20)->nullable();
            $table->tinyInteger('keep_price_same_ab')->default(0);
            $table->tinyInteger('cc_fee')->default(0);
            $table->dateTime('date_addded')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->integer('update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_master');
    }
}
