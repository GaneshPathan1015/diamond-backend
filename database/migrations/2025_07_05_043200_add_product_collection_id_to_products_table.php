<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // New foreign key for product_collections
            $table->unsignedBigInteger('product_collection_id')->nullable()->after('psc_id');
            $table->foreign('product_collection_id')
                ->references('id')
                ->on('product_collections')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop new foreign key
            $table->dropForeign(['product_collection_id']);
            $table->dropColumn('product_collection_id');
        });
    }
};
