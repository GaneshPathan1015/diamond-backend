<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('product_id');
            $table->decimal('carat', 8, 2);
            $table->decimal('price', 12, 2);
            $table->string('sku', 150)->unique();
            $table->string('master_sku', 150)->nullable(); 
            $table->integer('stock')->default(0);
            $table->json('weight');

            $table->unsignedBigInteger('shape_id')->nullable();         // diamond_shape_master.id
            $table->unsignedBigInteger('category_id')->nullable();      // categories.id
            $table->unsignedInteger('metal_color_id')->nullable();  // products_metal_color.id
            $table->unsignedBigInteger('vendor_id')->nullable();        // vendor_master.vendorid

            $table->timestamps();

            $table->foreign('product_id')
                ->references('products_id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('shape_id')
                ->references('id')
                ->on('diamond_shape_master')
                ->nullOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();

            $table->foreign('metal_color_id')
                ->references('dmc_id')
                ->on('products_metal_color')
                ->nullOnDelete();

            $table->foreign('vendor_id')
                ->references('vendorid')
                ->on('vendor_master')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};

