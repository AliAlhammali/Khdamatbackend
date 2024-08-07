<?php

use App\KhadamatTeck\Admin\MerchantClients\Models\MerchantClient;
use App\KhadamatTeck\Admin\MerchantUsers\Models\MerchantUser;
use App\KhadamatTeck\Admin\Orders\Models\Order;
use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Merchant::class);
            $table->foreignIdFor(MerchantUser::class);
            $table->foreignIdFor(MerchantClient::class);
            $table->foreignIdFor(\App\KhadamatTeck\Admin\Categories\Models\Category::class, 'main_category_id');
            $table->foreignIdFor(\App\KhadamatTeck\Admin\Categories\Models\Category::class);

            $table->string('status')->default('new');
            $table->string('order_otp')->nullable();
            $table->timestamps();
        });

        Schema::create('order_address', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->geometry('location')->nullable();
            $table->geometry('pick_up_location')->nullable();
            $table->boolean('is_default_address')->default(1);
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(ServiceModel::class, 'item_id');
            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('item_price', 8, 2);
            $table->decimal('sup_total', 64, 2)->default(0.00);
            $table->decimal('vat', 64, 2)->default(0.00);
            $table->unsignedDecimal('total', 8, 2);
            $table->timestamps();
        });

        Schema::create('order_totals', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Merchant::class);
            $table->foreignIdFor(MerchantUser::class);

            $table->unsignedDecimal('total', 64, 2)->default(0.00);
            $table->unsignedDecimal('sup_total', 64, 2)->default(0.00);
            $table->unsignedDecimal('vat', 64, 2)->default(0.00);

            $table->unsignedDecimal('merchant_user_commission_total', 64, 2)->default(0.00);
            $table->unsignedDecimal('merchant_user_commission_sup_total', 64, 2)->default(0.00);
            $table->unsignedDecimal('merchant_user_commission_vat', 64, 2)->default(0.00);

            $table->unsignedDecimal('sp_total', 64, 2)->default(0.00);
            $table->unsignedDecimal('sp_sup_total', 64, 2)->default(0.00);
            $table->unsignedDecimal('sp_vat', 64, 2)->default(0.00);

            $table->timestamps();
        });

        Schema::create('order_service_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(ServiceProvider::class);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('merchant_users', function (Blueprint $table) {
            $table->unsignedDecimal('order_commission_percentage', 64, 2)->default(0.00);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
