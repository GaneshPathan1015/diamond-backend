<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_collections', function (Blueprint $table) {
            $table->renameColumn('display_in_front', 'display_in_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_collections', function (Blueprint $table) {
            $table->renameColumn('display_in_menu', 'display_in_front');
        });
    }
};
