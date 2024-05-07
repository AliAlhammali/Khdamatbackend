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
        Schema::table('order_service_providers', function (Blueprint $table) {
            $table->foreignIdFor(\App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_service_providers', function (Blueprint $table) {
            //
        });
    }
};
