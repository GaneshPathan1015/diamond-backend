<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diamond_weight_group', function (Blueprint $table) {
            $table->increments('dwg_id');
            $table->string('dwg_name', 250)->nullable();
            $table->double('dwg_from')->nullable();
            $table->double('dwg_to')->nullable();
            $table->tinyInteger('dwg_status')->nullable();
            $table->integer('dwg_sort_order')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();

            // Custom datetime fields
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_updated')->nullable();

            // Laravel timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diamond_weight_group');
    }
};
