<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondCuletMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_culet_master', function (Blueprint $table) {
            $table->id('dc_id'); // Custom primary key
            $table->string('dc_name', 250)->nullable();
            $table->string('dc_short_name', 250)->nullable();
            $table->text('dc_alise')->nullable(); // Assuming "alias" typo was intentional
            $table->text('dc_remark')->nullable();
            $table->tinyInteger('dc_display_in_front')->nullable();
            $table->integer('dc_sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_culet_master');
    }
}
