<?php

namespace Database\Seeders;

use App\KhadamatTeck\Admin\Users\Models\User;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUsersToSystem extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::query()->truncate();
        ServiceProviderUser::query()->truncate();
        MerchantUser::query()->truncate();
        Merchant::query()->truncate();
        ServiceProvider::query()->truncate();


        Merchant::create([
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'status' => 'active',
            'logo' => fake()->imageUrl(),
            'vat_file' => 'https://mag.wcoomd.org/uploads/2018/05/blank.pdf',
            'cr_file' =>'https://mag.wcoomd.org/uploads/2018/05/blank.pdf',
            'sales_agreement_file' => 'https://mag.wcoomd.org/uploads/2018/05/blank.pdf',
            'cr_number' => 'cr_number',
            'vat_number' => 'vat_number',
            'email' => strtolower(fake()->title()).'@khadamat-teck.com',

        ]);

        ServiceProvider::create([
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'status' => 'active',
            'logo' => fake()->imageUrl(),
            'vat_file' => 'https://mag.wcoomd.org/uploads/2018/05/blank.pdf',
            'cr_file' =>'https://mag.wcoomd.org/uploads/2018/05/blank.pdf',
            'sales_agreement_file' => 'https://mag.wcoomd.org/uploads/2018/05/blank.pdf',
            'cr_number' => 'cr_number',
            'vat_number' => 'vat_number',
            'email' => strtolower(fake()->title()).'@khadamat-teck.com',

        ]);

        \App\Models\User::factory()->create([
            'name' => 'Portal Admin',
            'email' => 'portal-admin@khadamat-teck.com',
            'password' => bcrypt(123456),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'image' => fake()->imageUrl(),
            'role' => 'Admin',
            'status' => 'active',
        ]);
        \App\Models\User::factory(10)->create();


        ServiceProviderUser::factory()->create([
            'name' => 'SP Admin',
            'email' => 'sp-admin@khadamat-teck.com',
            'password' => bcrypt(123456),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'image' => fake()->imageUrl(),
            'status' => 'active',
            'role' => 'Admin',
            'service_provider_id' => 1,
            'is_owner' => 1,
        ]);
        ServiceProviderUser::factory(10)->create();


        MerchantUser::factory()->create([
            'name' => 'Merchant Admin',
            'email' => 'merchant-admin@khadamat-teck.test',
            'password' => bcrypt(123456),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'image' => fake()->imageUrl(),
            'status' => 'active',
            'role' => 'Admin',
            'merchant_id' => 1,
            'is_owner' => 1,
        ]);
        MerchantUser::factory(10)->create();


    }
}
