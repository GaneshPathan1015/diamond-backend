<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('products_options', function (Blueprint $table) {
            $table->increments('options_id');
            $table->string('options_name', 150)->nullable();
            $table->tinyInteger('options_type')->nullable();
            $table->bigInteger('sort_order')->nullable();
            $table->date('date_added')->nullable();
            $table->tinyInteger('is_compulsory')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_options');
    }
}
