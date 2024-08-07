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
        Schema::create('merchant_clients', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->geometry('location')->nullable();
            $table->boolean('is_active')->default(1);
            $table->foreignIdFor(\App\KhadamatTeck\Merchant\Merchants\Models\Merchant::class)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('merchant_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->geometry('location')->nullable();
            $table->foreignIdFor(\App\KhadamatTeck\Merchant\Merchants\Models\Merchant::class)->nullable();
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_branches');
        Schema::dropIfExists('merchant_clients');
    }
};
