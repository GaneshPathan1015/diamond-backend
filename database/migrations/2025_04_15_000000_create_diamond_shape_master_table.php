<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondShapeMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_shape_master', function (Blueprint $table) {
            $table->id(); // Automatically sets as primary key and auto-increment
            $table->string('name')->nullable();
            $table->string('ALIAS')->nullable();
            $table->string('shortname', 15)->nullable();
            $table->string('rap_shape')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->longText('svg_image')->nullable();
            $table->string('remark')->nullable();
            $table->integer('display_in_front')->nullable();
            $table->integer('display_in_stud')->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_shape_master');
    }
}
