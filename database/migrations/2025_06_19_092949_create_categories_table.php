<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->string('category_name', 150);
            $table->string('category_alias', 255)->nullable();
            $table->text('category_description')->nullable();
            $table->tinyInteger('is_display_front')->nullable();
            $table->string('category_image', 255)->nullable();
            $table->text('category_header_banner')->nullable();
            $table->tinyInteger('category_status')->nullable();
            $table->string('seo_url', 150)->nullable();
            $table->text('category_meta_title')->nullable();
            $table->text('category_meta_description')->nullable();
            $table->text('category_meta_keyword')->nullable();
            $table->string('category_h1_tag', 250)->nullable();
            $table->bigInteger('sort_order')->nullable();
            $table->tinyInteger('deleted')->nullable();
            $table->dateTime('category_date_added')->nullable();
            $table->dateTime('category_date_modified')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            // Self-referencing foreign key for parent_id
            $table->foreign('parent_id')
                  ->references('category_id')
                  ->on('categories')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('categories');
    }
};
