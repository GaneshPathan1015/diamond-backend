<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shop_zones', function (Blueprint $table) {
            $table->id('zone_id'); // Primary key

            $table->unsignedBigInteger('zone_country_id')->nullable();
            $table->string('zone_code', 100)->nullable();
            $table->string('zone_name', 100)->nullable();

            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modified')->nullable();

            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Indexes
            $table->index('zone_country_id');

            // Optional foreign keys (if users or countries exist)
            // $table->foreign('zone_country_id')->references('id')->on('countries')->nullOnDelete();
            // $table->foreign('added_by')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_zones');
    }
};

