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
        Schema::table('diamond_master', function (Blueprint $table) {
            $table->foreign('certificate_company')
                  ->references('dl_id')
                  ->on('diamond_lab_master')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diamond_master', function (Blueprint $table) {
            $table->dropForeign(['certificate_company']);
        });
    }
};
