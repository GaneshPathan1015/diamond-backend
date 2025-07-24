<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondQualityGroupTable extends Migration
{
    public function up()
    {
        Schema::create('diamond_quality_group', function (Blueprint $table) {
            $table->increments('dqg_id');
            $table->string('dqg_name', 250)->nullable();
            $table->text('dqg_alias')->nullable();
            $table->string('dqg_short_name', 250)->nullable();
            $table->text('description')->nullable();
            $table->text('dqg_icon')->nullable();
            $table->integer('dqg_sort_order')->nullable();
            $table->tinyInteger('dqg_status')->nullable();
            $table->text('dqg_origin')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('date_modified')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diamond_quality_group');
    }
}
