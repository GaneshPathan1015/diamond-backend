<?php
// database/migrations/2025_08_21_000000_create_carts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable(); // for guest users
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['ring', 'diamond', 'combo', 'build']);

            // store references depending on type
            $table->foreignId('product_id')->nullable()->constrained('product_variations')->nullOnDelete();
            $table->foreignId('diamondid')->nullable()->constrained('diamond_master')->nullOnDelete();

            $table->string('size')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);

            $table->json('meta')->nullable(); // any extra attributes
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
