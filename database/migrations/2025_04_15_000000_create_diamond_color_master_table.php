<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondColorMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_color_master', function (Blueprint $table) {
            $table->id(); // Primary key with auto-increment
            $table->string('name')->nullable();
            $table->string('short_name', 250)->nullable();
            $table->string('ALIAS')->nullable();
            $table->string('remark')->nullable();
            $table->integer('display_in_front')->nullable();
            $table->tinyInteger('dc_is_fancy_color')->nullable();
            $table->tinyInteger('sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_color_master');
    }
}
