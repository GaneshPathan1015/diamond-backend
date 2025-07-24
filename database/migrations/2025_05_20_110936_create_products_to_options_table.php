<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_to_options', function (Blueprint $table) {
            $table->id('products_to_option_id'); // Primary key

            $table->unsignedBigInteger('products_id')->nullable();
            $table->unsignedBigInteger('options_id')->nullable();
            $table->unsignedBigInteger('value_id')->nullable();

            $table->float('options_price')->nullable();
            $table->char('options_symbol', 1)->nullable();
            $table->float('estimated_weight')->nullable();
            $table->string('estimated_symbol', 1)->nullable();
            $table->integer('sort_order')->nullable();
            $table->string('option_image', 255)->nullable();

            // Indexes
            $table->index('products_id');
            $table->index('options_id');
            $table->index('value_id');

            // Optional foreign keys
            $table->foreign('products_id')->references('products_id')->on('products')->nullOnDelete();
            $table->foreign('options_id')->references('options_id')->on('products_options')->nullOnDelete();
            $table->foreign('value_id')->references('value_id')->on('products_options_values')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_to_options');
    }
};
