<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('title')->nullable()->after('id');
            $table->date('dob')->nullable()->after('user_type');
            $table->date('anniversary_date')->nullable()->after('dob');
            $table->string('image')->nullable()->after('anniversary_date');
            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 = active, 0 = user requested deletion, 2 = locked by admin')
                ->after('image');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['title', 'dob', 'anniversary_date','image','status']);
        });
    }
};
