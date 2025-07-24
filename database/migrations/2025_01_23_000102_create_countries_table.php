<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id('country_id'); // Primary key with custom name
            $table->string('country_name', 100)->unique(); // Country name with uniqueness constraint
            
            // Optional common columns
            $table->string('iso_code_2', 2)->nullable()->comment('ISO 3166-1 alpha-2 code');
            $table->string('iso_code_3', 3)->nullable()->comment('ISO 3166-1 alpha-3 code');
            $table->string('phone_code', 10)->nullable()->comment('International calling code');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};