<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products_metal_color', function (Blueprint $table) {
            $table->increments('dmc_id'); // Primary key
            $table->string('dmc_name', 250)->nullable();
            $table->tinyInteger('dmc_status')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('date_modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_metal_color');
    }
};
