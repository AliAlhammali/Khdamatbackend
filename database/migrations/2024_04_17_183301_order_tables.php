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
        Schema::table('order_totals', function (Blueprint $table) {
            $table->decimal('profit_sup_total')->default(0);
            $table->decimal('profit_vat')->default(0);
            $table->decimal('profit_total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_totals', function (Blueprint $table) {
            //
        });
    }
};
