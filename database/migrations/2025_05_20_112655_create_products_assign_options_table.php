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
        Schema::create('products_assign_options', function (Blueprint $table) {
            $table->integer('products_id')->default(0);
            $table->integer('options_id')->default(0);

            // Composite primary key
            $table->primary(['products_id', 'options_id']);

            // Individual BTREE indexes
            $table->index('products_id');
            $table->index('options_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_assign_options');
    }
};
