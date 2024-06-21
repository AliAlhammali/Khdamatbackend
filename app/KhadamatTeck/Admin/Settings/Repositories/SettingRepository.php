<?php


namespace App\KhadamatTeck\Admin\Settings\Repositories;


use App\KhadamatTeck\Admin\Settings\Models\Setting;
use App\KhadamatTeck\Base\Repository;

class SettingRepository extends Repository
{
    public function getModel()
    {
        return Setting::class;
    }
}
