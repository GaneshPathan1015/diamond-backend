<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondSizeMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_size_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 250)->nullable();
            $table->double('size1')->nullable();
            $table->double('size2')->nullable();
            $table->integer('retailer_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_size_master');
    }
}
