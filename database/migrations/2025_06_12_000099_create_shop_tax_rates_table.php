<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shop_tax_rates', function (Blueprint $table) {
            $table->increments('tax_rates_id');

            $table->unsignedInteger('tax_zone_id')->nullable();
            $table->unsignedInteger('tax_class_id')->nullable();
            $table->tinyInteger('tax_priority')->nullable();
            $table->decimal('tax_rate', 15, 2)->nullable();
            $table->string('tax_description', 255)->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('tax_retailer_id')->default(0);

            // Foreign Keys
            $table->foreign('tax_zone_id')
                  ->references('zone_id')->on('shop_zones')
                  ->onDelete('set null');

            $table->foreign('tax_class_id')
                  ->references('tax_class_id')->on('shop_tax_classes')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_tax_rates');
    }
};
