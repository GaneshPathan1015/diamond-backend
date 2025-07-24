<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products_style_group', function (Blueprint $table) {
            $table->increments('psg_id');
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('product_collections')
                  ->onDelete('set null');

            $table->json('psg_names')->nullable();

            $table->string('psg_image', 250)->nullable();
            $table->tinyInteger('psg_status')->nullable();
            $table->integer('psg_sort_order')->nullable();
            $table->text('psg_alias')->nullable();
            $table->tinyInteger('psg_display_in_front')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products_style_group', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);
        });

        Schema::dropIfExists('products_style_group');
    }
};