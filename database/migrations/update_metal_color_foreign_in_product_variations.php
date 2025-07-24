<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            // 1. Drop old foreign key (make sure constraint name matches or use DB::statement if needed)
            $table->dropForeign(['metal_color_id']);

            // 2. Add new foreign key to metal_type.dmt_id
            $table->foreign('metal_color_id')
                ->references('dmt_id')
                ->on('metal_type')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            // Rollback: drop new FK and add back old FK to products_metal_color.dmc_id
            $table->dropForeign(['metal_color_id']);

            $table->foreign('metal_color_id')
                ->references('dmc_id')
                ->on('products_metal_color')
                ->nullOnDelete();
        });
    }
};
