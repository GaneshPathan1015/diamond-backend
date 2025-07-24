<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_style_group_id')->nullable()->after('product_collection_id');

            $table->foreign('product_style_group_id')
                ->references('psg_id')
                ->on('products_style_group')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_style_group_id']);
            $table->dropColumn('product_style_group_id');
        });
    }
};
