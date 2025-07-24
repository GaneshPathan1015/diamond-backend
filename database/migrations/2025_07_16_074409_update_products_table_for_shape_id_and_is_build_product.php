<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableForShapeIdAndIsBuildProduct extends Migration
{
    public function up()
    {
        // Step 1: Convert is_build_product to boolean
        DB::statement("ALTER TABLE `products` MODIFY `is_build_product` TINYINT(1) NOT NULL DEFAULT 0");

        // Step 2: Drop shape_id (foreign key + column)
        if (Schema::hasColumn('products', 'shape_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['shape_id']);
            });

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('shape_id');
            });
        }

        // Step 3: Add new shape_ids JSON column
        if (!Schema::hasColumn('products', 'shape_ids')) {
            Schema::table('products', function (Blueprint $table) {
                $table->json('shape_ids')->nullable()->after('metal_weight');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('products', 'shape_ids')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('shape_ids');
            });
        }

        DB::statement("ALTER TABLE `products` MODIFY `is_build_product` VARCHAR(150) NULL");

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('shape_id')->nullable()->index();
            $table->foreign('shape_id')->references('id')->on('diamond_shape_master')->onDelete('set null');
        });
    }
}
