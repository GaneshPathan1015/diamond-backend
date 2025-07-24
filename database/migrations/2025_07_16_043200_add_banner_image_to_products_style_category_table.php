<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products_style_category', function (Blueprint $table) {
            $table->string('banner_image', 255)->nullable()->after('psc_image');
        });
    }

    public function down(): void
    {
        Schema::table('products_style_category', function (Blueprint $table) {
            $table->dropColumn('banner_image');
        });
    }
};
