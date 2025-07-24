<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsClarityMasterTable extends Migration
{
    public function up()
    {
        Schema::create('products_clarity_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('alias', 255)->nullable();
            $table->string('remark', 255)->nullable();
            $table->integer('display_in_front')->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_clarity_master');
    }
}