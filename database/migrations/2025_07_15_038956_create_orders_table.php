<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('user_name');
            $table->string('contact_number');
            
            $table->json('items_id')->nullable();
            $table->json('item_details')->nullable();
            
            $table->decimal('total_price', 10, 2)->default(0);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            
            // Fixed address structure
            $table->json('address')->nullable();
            
            $table->string('payment_mode');
            $table->string('payment_status')->default('pending');
            $table->string('order_status')->default('pending');
            $table->dateTime('delivery_date')->nullable();
            
            $table->enum('product_type', ['diamond', 'jewelry', 'mixed']); // Added 'mixed' type
            $table->string('certificate_number')->nullable();
            $table->string('metal_type')->nullable();
            $table->string('metal_color')->nullable();
            $table->string('metal_purity')->nullable();
            $table->text('stone_details')->nullable();
            $table->string('size')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};