<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('products_id');
            $table->string('products_name', 255)->nullable();
            $table->text('products_description')->nullable();
            $table->string('products_short_description', 255)->nullable();
            $table->enum('available', ['yes', 'no'])->default('no');
            $table->integer('products_quantity')->nullable();
            $table->string('products_model', 150)->nullable();
            $table->string('products_sku', 150)->nullable();
            $table->string('master_sku', 255)->nullable();
            $table->double('products_price')->nullable();
            $table->double('products_price1')->nullable();
            $table->double('products_price2')->nullable();
            $table->double('products_price3')->nullable();
            $table->double('products_price4')->nullable();
            $table->decimal('products_weight', 15, 2)->nullable();
            $table->tinyInteger('products_status')->nullable();
            $table->tinyInteger('engraving_status')->nullable();
            $table->string('products_slug', 150)->nullable();
            $table->string('catelog_no', 255)->nullable();
            $table->integer('vendor_id')->nullable()->index();
            $table->string('vendor_stock_no', 255)->nullable();
            $table->double('vendor_price')->nullable();
            $table->integer('categories_id')->nullable()->index();
            $table->integer('country_of_origin')->nullable();
            $table->tinyInteger('products_tax_class_id')->nullable()->index();
            $table->double('products_tax')->nullable();
            $table->tinyInteger('is_bestseller')->nullable();
            $table->tinyInteger('is_featured')->nullable();
            $table->boolean('ready_to_ship')->default(false);
            $table->tinyInteger('is_collection')->nullable(); 
            $table->tinyInteger('is_new')->nullable();
            $table->tinyInteger('is_superdeals')->nullable();
            $table->integer('diamond_weight_group_id')->nullable()->index();
            $table->integer('diamond_quality_id')->nullable()->index();
            $table->integer('diamond_clarity_id')->nullable()->index();
            $table->integer('diamond_color_id')->nullable()->index();
            $table->integer('diamond_cut_id')->nullable()->index();
            $table->integer('diamond_pics')->nullable();
            $table->integer('side_diamond_quality_id')->nullable()->index();
            $table->text('side_diamond_breakdown')->nullable(); 
            $table->double('semi_mount_ct_wt')->nullable();
            $table->double('total_carat_weight')->nullable();
            $table->double('semi_mount_price')->nullable();
            $table->double('center_stone_price')->nullable();
            $table->double('center_stone_weight')->nullable();
            $table->integer('center_stone_type_id')->nullable()->index();
            $table->integer('stone_type_id')->nullable();
            $table->integer('metal_type_id')->nullable()->index();
            $table->integer('metal_color_id')->nullable()->index();
            $table->double('metal_weight')->nullable();
            $table->string('is_build_product', 150)->nullable();
            $table->enum('build_product_type', ['yes', 'no'])->default('no');
            $table->tinyInteger('is_matching_set')->nullable();
            $table->text('product_keywords')->nullable();
            $table->text('product_promotion')->nullable();
            $table->text('certified_lab')->nullable();
            $table->text('certificate_number')->nullable();
            $table->string('products_related_items', 255)->nullable();
            $table->string('related_master_sku', 255)->nullable();
            $table->text('products_meta_title')->nullable();
            $table->text('products_meta_description')->nullable();
            $table->text('products_meta_keyword')->nullable();
            $table->integer('delivery_days')->nullable();
            $table->string('default_size', 10)->default('0');
            $table->tinyInteger('deleted')->nullable();
            $table->bigInteger('sort_order', false, true)->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->unsignedBigInteger('shape_id')->nullable()->index();
            $table->foreign('shape_id')->references('id')->on('diamond_shape_master')->onDelete('set null');

            $table->unsignedBigInteger('shop_zone_id')->nullable()->index();
            $table->foreign('shop_zone_id')->references('zone_id')->on('shop_zones')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}