<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('geo_zones', function (Blueprint $table) {
            $table->increments('geo_zone_id'); // Primary Key
            $table->string('geo_zone_name', 100)->nullable();
            $table->string('geo_zone_description', 255)->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_zones');
    }
};