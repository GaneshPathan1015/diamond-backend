<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondMasterTable extends Migration
{
    public function up(): void
    {
        Schema::create('diamond_master', function (Blueprint $table) {
            // Primary
            $table->increments('diamondid');

            // Basic
            $table->tinyInteger('diamond_type')->default(1)
                  ->comment('1 = Natural, 2 = CVD');
            $table->integer('quantity')->default(0);

            // Vendor info
            $table->unsignedBigInteger('vendor_id')->default(0);
            $table->string('vendor_stock_number', 100)->nullable();
            $table->string('stock_number', 100)->nullable();
            $table->string('same_diamond_stock_number')->nullable();

            // Core attributes
            $table->unsignedBigInteger('shape')->default(0);
            // Allow color to be nullable with default null
            $table->unsignedBigInteger('color')
                  ->nullable()
                  ->default(null);
            $table->unsignedBigInteger('clarity')->default(0);
            // $table->unsignedBigInteger('cut')->default(0);
                $table->unsignedBigInteger('cut')->nullable()->default(null)->comment('nullable for safe inserts');
            $table->float('carat_weight')->default(0);

            // Pricing
            $table->string('delivery_days', 25)->nullable();
            $table->float('price_per_carat')->default(0);
            $table->float('msrp_price')->default(0);
            $table->float('vendor_price')->default(0);
            $table->float('vendor_rap_disc')->default(0);
            $table->float('vendor_amount')->default(0);
            $table->float('price')->default(0);
            $table->double('diamond_price1')->default(0); 
            $table->double('diamond_price2')->default(0);
            $table->double('diamond_price3')->default(0);
            $table->double('diamond_price4')->default(0);
            $table->float('rap_percentage')->default(0);
            $table->float('memo_price_per_carat')->nullable();
            $table->float('memo_rap_disc')->nullable();
            $table->double('memo_price')->nullable();

            // Certificate
            $table->unsignedInteger('certificate_company')->default(0);
            $table->string('certificate_number', 100)->nullable();
            $table->string('certificate_name', 250)->nullable();
            $table->string('certificate_date', 150)->nullable();

            // Fancy color
            $table->tinyInteger('is_fancy_color')->nullable();
            $table->string('fancy_color', 50)->nullable();
            $table->unsignedInteger('fancy_color_id')->nullable();
            $table->unsignedBigInteger('fancy_color_intensity')->nullable();
            $table->unsignedInteger('fancy_color_overtone')->nullable();
            $table->unsignedInteger('fancy_color_overtone2')->nullable();

            // Measurements
            $table->string('measurements', 250)->nullable();
            $table->double('measurement_h')->nullable();
            $table->double('measurement_w')->nullable();
            $table->double('measurement_l')->nullable();
            $table->float('depth')->nullable();
            $table->float('table_diamond')->nullable();
            $table->string('crown_height', 50)->nullable();
            $table->string('crown_angle', 50)->nullable();
            $table->string('pavillion_depth', 50)->nullable();
            $table->string('pavillion_angle', 50)->nullable();
            $table->string('girdle')->nullable();
            $table->integer('girdle_thin')->nullable();
            $table->integer('girdle_thick')->nullable();
            $table->string('girdle_condition', 250)->nullable();

            // Grading & media
            $table->string('cut_grade', 100)->nullable();
            $table->tinyInteger('on_hand')->nullable();
            $table->integer('status')->nullable();
            $table->string('milky', 50)->nullable();
            $table->string('black', 50)->nullable();
            $table->text('image_link')->nullable();
            $table->text('cert_link')->nullable();
            $table->text('video_link')->nullable();

            // Additional
            $table->bigInteger('sort_order')->nullable();
            $table->tinyInteger('availability')->nullable()
                  ->comment('0=hold,1=available,2=memo');
            $table->tinyInteger('is_superdeal')->nullable()
                  ->comment('1=Yes,0=No');
            $table->unsignedInteger('locationid')->nullable();
            $table->double('sales_price')->nullable();
            $table->text('key_to_symbol')->nullable();
            $table->string('key_to_symbol_id')->nullable();
            $table->string('eye_clean')->nullable();
            $table->string('base_color')->nullable();
            $table->integer('shade')->nullable();
            $table->tinyInteger('is_hearts_arrows')->default(0);
            $table->string('center_black')->nullable();
            $table->tinyInteger('is_new_diamond')->default(0);
            $table->text('additional_field')->nullable();
            $table->string('user_field1')->nullable();
            $table->string('user_field2')->nullable();
            $table->string('user_field3')->nullable();
            $table->string('user_field4')->nullable();
            $table->string('user_field5')->nullable();
            $table->string('user_field6')->nullable();
            $table->string('diamond_seo', 250)->nullable();
            $table->tinyInteger('giacheck')->default(0);
            $table->text('customer_group')->nullable();
            $table->tinyInteger('stone_offer')->default(0);
            $table->tinyInteger('is_offer_stone')->default(0);
            $table->string('fancy_cut_grade', 100)->nullable();

            $table->unsignedBigInteger('polish')->nullable();
            $table->unsignedBigInteger('symmetry')->nullable();
            $table->unsignedBigInteger('fluorescence')->nullable();
            $table->unsignedBigInteger('culet')->nullable();

            // Timestamps & audit
            $table->dateTime('date_added')->nullable();
            $table->tinyInteger('added_by')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->tinyInteger('updated_by')->nullable();

            // Foreign Keys with CASCADE DELETE
            $table->foreign('vendor_id')
                  ->references('vendorid')->on('vendor_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('shape')
                  ->references('id')->on('diamond_shape_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('color')
                  ->references('id')->on('diamond_color_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('clarity')
                  ->references('id')->on('diamond_clarity_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('cut')
                  ->references('id')->on('diamond_cut_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('certificate_company')
                  ->references('dl_id')->on('diamond_lab_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('fancy_color_intensity')
                  ->references('fci_id')->on('diamond_fancycolor_intensity_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('fancy_color_overtone')
                  ->references('fco_id')->on('diamond_fancycolor_overtones_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('culet')
                  ->references('dc_id')->on('diamond_culet_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('fluorescence')
                  ->references('id')->on('diamond_flourescence_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('polish')
                  ->references('id')->on('diamond_polish_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('symmetry')
                  ->references('id')->on('diamond_symmetry_master')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('diamond_master', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['shape']);
            $table->dropForeign(['color']);
            $table->dropForeign(['clarity']);
            $table->dropForeign(['cut']);
            $table->dropForeign(['certificate_company']);
            $table->dropForeign(['fancy_color_intensity']);
            $table->dropForeign(['fancy_color_overtone']);
            $table->dropForeign(['culet']);
            $table->dropForeign(['fluorescence']);
            $table->dropForeign(['polish']);
            $table->dropForeign(['symmetry']);
        });

        Schema::dropIfExists('diamond_master');
    }
}