<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_to_style_group', function (Blueprint $table) {
            $table->id('sptsg_id'); // Primary Key

            $table->unsignedBigInteger('sptsg_products_id')->nullable();
            $table->unsignedBigInteger('sptsg_style_category_id')->nullable();

            // Indexes
            $table->index('sptsg_products_id');
            $table->index('sptsg_style_category_id');

            // Optional foreign keys
            $table->foreign('sptsg_products_id')->references('products_id')->on('products')->nullOnDelete();
            $table->foreign('sptsg_style_category_id')->references('psc_id')->on('products_style_category')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_to_style_group');
    }
};
