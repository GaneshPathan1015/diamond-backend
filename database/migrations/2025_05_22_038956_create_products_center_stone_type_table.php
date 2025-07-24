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
        Schema::create('products_center_stone_type', function (Blueprint $table) {
            $table->increments('dcst_id'); // Primary key
            $table->string('dcst_name', 250)->nullable()->comment('use for origin only');
            $table->string('dcst_short_name')->nullable();
            $table->string('dcst_image')->nullable();
            $table->integer('dcst_sort_order')->nullable();
            $table->tinyInteger('dcst_status')->nullable();
            $table->string('dcst_size_flag', 50)->nullable();
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
        Schema::dropIfExists('products_center_stone_type');
    }
};
