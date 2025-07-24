<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondLabMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_lab_master', function (Blueprint $table) {
            $table->increments('dl_id');
            $table->string('dl_name', 250)->nullable();
            $table->tinyInteger('dl_display_in_front')->default(0);
            $table->integer('dl_sort_order')->nullable();
            $table->string('image', 255);
            $table->string('cert_url', 255)->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_lab_master');
    }
}
