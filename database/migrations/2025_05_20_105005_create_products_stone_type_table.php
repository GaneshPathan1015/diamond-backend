<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsStoneTypeTable extends Migration
{
    public function up()
    {
        Schema::create('products_stone_type', function (Blueprint $table) {
            $table->increments('pst_id');
            $table->integer('pst_category_id')->nullable()->index();
            $table->text('pst_name')->nullable();
            $table->string('pst_alias', 250)->nullable();
            $table->text('pst_description')->nullable();
            $table->string('pst_image', 250)->nullable();
            $table->tinyInteger('pst_status')->nullable();
            $table->integer('pst_sort_order')->nullable();
            $table->tinyInteger('pst_display_in_front')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_stone_type');
    }
}

