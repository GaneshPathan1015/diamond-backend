<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetalTypeTable extends Migration
{
    public function up()
    {
        Schema::create('metal_type', function (Blueprint $table) {
            $table->increments('dmt_id');
            $table->string('dmt_name', 250)->nullable();
            $table->string('dmt_tooltip', 255)->nullable();
            $table->tinyInteger('dmt_status')->nullable();
            $table->tinyInteger('sort_order')->nullable();
            $table->string('color_code', 100)->nullable();
            $table->text('metal_icon')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('date_modified')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metal_type');
    }
}
