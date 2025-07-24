<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    { 
        Schema::create('shop_zones_to_geo_zones', function (Blueprint $table) {
            $table->id('association_id'); // Primary key
            
            // Foreign keys with proper column naming
            $table->unsignedBigInteger('country_id')->nullable()->comment('References countries table');
            $table->unsignedBigInteger('zone_id')->nullable()->comment('References shop_zones table');
            $table->unsignedBigInteger('products_id')->nullable()->comment('References products table');
            $table->unsignedBigInteger('geo_zone_id')->nullable()->comment('References geo_zones table');
            
            // Standardized timestamp handling
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            // User references
            $table->unsignedBigInteger('created_by')->nullable()->comment('Admin user who created');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('Admin user who updated');

            // Indexes for all foreign keys
            $table->index('country_id');
            $table->index('zone_id');
            $table->index('products_id');
            $table->index('geo_zone_id');
            $table->index('created_by');
            $table->index('updated_by');

            // Foreign key constraints with proper cascade handling
            $table->foreign('country_id', 'fk_z2g_country')
                ->references('country_id')
                ->on('countries')
                ->nullOnDelete();
                
            $table->foreign('zone_id', 'fk_z2g_zone')
                ->references('zone_id')
                ->on('shop_zones')
                ->nullOnDelete();

            $table->foreign('products_id', 'fk_z2g_products')
                ->references('products_id')
                ->on('products')
                ->nullOnDelete();
                
            $table->foreign('geo_zone_id', 'fk_z2g_geo_zone')
                ->references('geo_zone_id')
                ->on('geo_zones')
                ->nullOnDelete();
                
            $table->foreign('created_by', 'fk_z2g_created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
                
            $table->foreign('updated_by', 'fk_z2g_updated_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('shop_zones_to_geo_zones', function (Blueprint $table) {
            // Remove foreign keys first
            $table->dropForeign('fk_z2g_country');
            $table->dropForeign('fk_z2g_zone');
            $table->dropForeign('fk_z2g_products');
            $table->dropForeign('fk_z2g_geo_zone');
            $table->dropForeign('fk_z2g_created_by');
            $table->dropForeign('fk_z2g_updated_by');
        });
        
        Schema::dropIfExists('shop_zones_to_geo_zones');
    }
};
