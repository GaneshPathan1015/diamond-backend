<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_to_style_category', function (Blueprint $table) {
            $table->id('sptsc_id'); // Primary Key

            $table->unsignedBigInteger('sptsc_products_id')->nullable();
            $table->unsignedBigInteger('sptsc_style_category_id')->nullable();

            // Indexes
            $table->index('sptsc_products_id');
            $table->index('sptsc_style_category_id');

            // Foreign keys with correct references
            $table->foreign('sptsc_products_id')
                  ->references('products_id')  // Matches products table PK
                  ->on('products')
                  ->nullOnDelete();

            $table->foreign('sptsc_style_category_id')
                  ->references('psc_id')  // Matches style_categories table PK
                  ->on('products_style_category')
                  ->nullOnDelete();
                  
            // Add unique constraint to prevent duplicate relationships
            $table->unique(
                ['sptsc_products_id', 'sptsc_style_category_id'],
                'unique_product_style_category'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_to_style_category');
    }
};