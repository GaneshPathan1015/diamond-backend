<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_to_categories', function (Blueprint $table) {
            $table->id(); // 👈 Primary key ID
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('products_id')->references('products_id')->on('products')->onDelete('cascade');
            $table->foreign('categories_id')->references('category_id')->on('categories')->onDelete('cascade');

            // Unique constraint to avoid duplicate entries
            $table->unique(['products_id', 'categories_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_to_categories');
    }
};
