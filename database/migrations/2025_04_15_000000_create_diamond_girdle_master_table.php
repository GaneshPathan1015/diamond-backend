<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondGirdleMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_girdle_master', function (Blueprint $table) {
            $table->id('dg_id'); // Custom primary key
            $table->string('dg_name', 250)->nullable();
            $table->string('dg_short_name', 250)->nullable();
            $table->text('dg_alise')->nullable(); // Assuming "alias" typo was intentional
            $table->text('dg_remark')->nullable();
            $table->tinyInteger('dg_display_in_front')->nullable();
            $table->integer('dg_sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_girdle_master');
    }
}
