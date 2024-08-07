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
        if (!Schema::hasColumn('order_items', 'category_id'))
            Schema::table('order_items', function (Blueprint $table) {
                $table->string('category_id')->nullable();
            });
        if (Schema::hasColumn('orders', 'category_id'))
            Schema::table('orders', function (Blueprint $table) {
                $table->string('category_id')->nullable()->change();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
