<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondPolishMasterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diamond_polish_master', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name', 250)->nullable();
            $table->string('alias')->nullable();
            $table->string('short_name', 150)->nullable();
            $table->string('full_name')->nullable();
            $table->tinyInteger('pol_status')->nullable();
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
        Schema::dropIfExists('diamond_polish_master');
    }
}
