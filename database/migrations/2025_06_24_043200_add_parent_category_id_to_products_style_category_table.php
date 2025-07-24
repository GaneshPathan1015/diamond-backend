<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentCategoryIdToProductsStyleCategoryTable extends Migration
{
    public function up(): void
    {
        Schema::table('products_style_category', function (Blueprint $table) {
            $table->unsignedInteger('parent_category_id')->nullable()->after('psc_category_id');

            $table->foreign('parent_category_id')
                ->references('category_id')
                ->on('categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products_style_category', function (Blueprint $table) {
            $table->dropForeign(['parent_category_id']);
            $table->dropColumn('parent_category_id');
        });
    }
}