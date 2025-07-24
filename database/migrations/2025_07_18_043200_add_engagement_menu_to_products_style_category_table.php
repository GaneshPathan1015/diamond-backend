<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEngagementMenuToProductsStyleCategoryTable extends Migration
{
    public function up(): void
    {
        Schema::table('products_style_category', function (Blueprint $table) {
            $table->boolean('engagement_menu')->default(0)->after('parent_category_id');
        });
    }

    public function down(): void
    {
        Schema::table('products_style_category', function (Blueprint $table) {
            $table->dropColumn(['engagement_menu']);
        });
    }
}
