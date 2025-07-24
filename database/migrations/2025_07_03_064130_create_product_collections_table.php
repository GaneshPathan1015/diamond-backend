<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_category_id')->nullable();
            $table->unsignedInteger('parent_category_id')->nullable();
            $table->string('name');
            $table->string('collection_image');
            $table->integer('status')->default(0);
            $table->integer('sort_order')->nullable()->default(0);
            $table->string('alias')->nullable();
            $table->integer('display_in_front')->nullable()->default(1);
            $table->dateTime('date_added')->useCurrent();
            $table->dateTime('date_modified')->useCurrent()->useCurrentOnUpdate();

            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            $table->foreign('product_category_id')->references('category_id')->on('categories')->onDelete('CASCADE');
            $table->foreign('parent_category_id')->references('category_id')->on('categories')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_collections');
    }
};
