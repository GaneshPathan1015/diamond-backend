<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('products_id')->nullable()->index();
            $table->string('image_path', 250)->nullable();
            $table->tinyInteger('is_featured')->default(0)->comment('1 = featured, 0 = not featured');
            $table->timestamps();

            // Foreign key
            $table->foreign('products_id')->references('products_id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products_image', function (Blueprint $table) {
            $table->dropForeign(['products_id']);
        });

        Schema::dropIfExists('products_image');
    }
};
