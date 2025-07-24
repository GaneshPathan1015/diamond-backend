<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_to_shape', function (Blueprint $table) {
            $table->id('pts_id'); // Primary key, auto-increment

            $table->unsignedBigInteger('products_id')->nullable();
            $table->unsignedBigInteger('shape_id')->nullable();

            // Indexes
            $table->index('products_id');
            $table->index('shape_id');

            // Optional foreign keys
            $table->foreign('products_id')->references('products_id')->on('products')->nullOnDelete();
            $table->foreign('shape_id')->references('id')->on('diamond_shape_master')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_to_shape');
    }
};

