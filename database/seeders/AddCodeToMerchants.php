<?php

namespace Database\Seeders;

use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AddCodeToMerchants extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchant::orderBy('id')->chunk(100, function (Collection $merchants) {
            foreach ($merchants as $merchant) {
                $merchant->code = uniqid();
                $merchant->save();
            }
        });
    }
}
