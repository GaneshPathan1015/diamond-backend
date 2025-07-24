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
        Schema::table('product_variations', function (Blueprint $table) {
            //
            $table->dropColumn('weight');
        });

        Schema::table('product_variations', function (Blueprint $table) {
            // Add weight as JSON
            $table->json('weight')->after('stock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            //

             $table->dropColumn('weight');
        });

        Schema::table('product_variations', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->after('stock')->nullable();
        });
    }
};
