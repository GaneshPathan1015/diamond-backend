<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondShadeMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_shade_master', function (Blueprint $table) {
            $table->id('ds_id'); // Custom primary key
            $table->string('ds_name', 250)->nullable();
            $table->string('ds_short_name', 250)->nullable();
            $table->text('ds_alise')->nullable(); // Retaining original column name
            $table->text('ds_remark')->nullable();
            $table->tinyInteger('ds_display_in_front')->nullable();
            $table->integer('ds_sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_shade_master');
    }
}
