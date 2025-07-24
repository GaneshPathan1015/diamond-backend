<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondFancycolorIntensityMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_fancycolor_intensity_master', function (Blueprint $table) {
            $table->id('fci_id'); // Custom primary key
            $table->string('fci_name', 250)->nullable();
            $table->string('fci_short_name', 250)->nullable();
            $table->text('fci_alias')->nullable(); // Corrected column name
            $table->text('fci_remark')->nullable();
            $table->tinyInteger('fci_display_in_front')->nullable();
            $table->integer('fci_sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_fancycolor_intensity_master');
    }
}
