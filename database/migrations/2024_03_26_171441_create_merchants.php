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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->string('logo')->nullable();
            $table->string('vat_file')->nullable();
            $table->string('cr_file')->nullable();
            $table->string('sales_agreement_file')->nullable();
            $table->string('cr_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('merchant_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\KhadamatTeck\Merchant\Merchants\Models\Merchant::class);
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('role')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
