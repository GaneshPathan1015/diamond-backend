<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsToMetalTypeTable extends Migration
{
    public function up()
    {
        Schema::create('products_to_metal_type', function (Blueprint $table) {
            $table->increments('sptmt_id');
            $table->integer('sptmt_products_id')->nullable()->index();
            $table->integer('sptmt_metal_type_id')->nullable()->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_to_metal_type');
    }
}
