<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondFancycolorOvertonesMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_fancycolor_overtones_master', function (Blueprint $table) {
            $table->increments('fco_id');
            $table->string('fco_name', 250)->nullable();
            $table->string('fco_short_name', 250)->nullable();
            $table->text('fco_alise')->nullable();
            $table->text('fco_remark')->nullable();
            $table->tinyInteger('fco_display_in_front')->nullable();
            $table->integer('fco_sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_fancycolor_overtones_master');
    }
}
