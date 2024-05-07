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
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedDecimal('sp_item_price', 8, 2);
            $table->decimal('sp_sup_total', 64, 2)->default(0.00);
            $table->decimal('sp_vat', 64, 2)->default(0.00);
            $table->unsignedDecimal('sp_total', 8, 2);
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
