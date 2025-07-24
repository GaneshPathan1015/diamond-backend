<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_to_stone_type', function (Blueprint $table) {
            $table->id('sptst_id'); // Primary key

            $table->unsignedBigInteger('sptst_products_id')->nullable();
            $table->unsignedBigInteger('sptst_stone_type_id')->nullable();

            // Indexes
            $table->index('sptst_products_id');
            $table->index('sptst_stone_type_id');

            // Optional: Foreign keys
            $table->foreign('sptst_products_id')->references('products_id')->on('products')->nullOnDelete();
            $table->foreign('sptst_stone_type_id')->references('pst_id')->on('stone_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_to_stone_type');
    }
};

