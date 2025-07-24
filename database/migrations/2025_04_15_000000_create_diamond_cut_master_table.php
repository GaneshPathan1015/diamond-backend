<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondCutMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_cut_master', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name')->nullable();
            $table->string('ALIAS')->nullable();
            $table->string('shortname', 10)->nullable();
            $table->string('full_name')->nullable();
            $table->string('remark')->nullable();
            $table->integer('display_in_front')->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond_cut_master');
    }
}
