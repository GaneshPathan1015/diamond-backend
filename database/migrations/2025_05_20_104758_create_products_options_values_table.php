<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOptionsValuesTable extends Migration
{
    public function up()
    {
        Schema::create('products_options_values', function (Blueprint $table) {
            $table->increments('value_id');
            $table->integer('options_id')->nullable()->index();
            $table->string('value_name', 150)->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_options_values');
    }
}
