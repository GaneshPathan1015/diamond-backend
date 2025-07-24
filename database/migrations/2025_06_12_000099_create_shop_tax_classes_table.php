<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_tax_classes', function (Blueprint $table) {
            $table->increments('tax_class_id');
            $table->string('tax_class_title', 100)->nullable();
            $table->string('tax_class_description', 255)->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            // if you want Laravel timestamps instead, you can replace above two with:
            // $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_tax_classes');
    }
};
