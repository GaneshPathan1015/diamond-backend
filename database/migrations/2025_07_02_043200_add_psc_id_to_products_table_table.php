<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('psc_id')->nullable()->after('parent_category_id');

            $table->foreign('psc_id')
                ->references('psc_id')
                ->on('products_style_category')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['psc_id']);
            $table->dropColumn('psc_id');
        });
    }
};
