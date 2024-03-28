<?php

namespace App\KhadamatTeck\Base\Traits;

use App\KhadamatTeck\Settings\DTO\SettingsDTO;
use Illuminate\Support\Collection;
use KhadamatTeck\Companies\Models\Company;

trait SettingsUtils
{
    public function getSetting($companyId, $defaultKey = [], $asKeyValue = true, $group = null): Collection
    {
        $company = Company::find($companyId ?? pmsAuth()->getPmsCompanyId());
        $settingsHelper = settings()->for($company);

        if ($group) {
            $settingsHelper = $settingsHelper->group($group);
        }

//        $settings->setExtraColumns(['user_id' => $userId]);
        $settings = $settingsHelper->all();

        // Merge the default settings with the stored settings.
        $mergedSettings = array_merge($defaultKey, $settings);

        // Save the merged settings.
        $settingsHelper->set($mergedSettings);

        $output = [];
        if ($asKeyValue) {
            // Return the result in list of [key => value]
            foreach ($mergedSettings as $key => $value) {
                if (array_key_exists($key, $defaultKey))
                    $output[$key] = $value;
            }
        } else {
            // Group the result by the first word of the keys
            foreach ($mergedSettings as $key => $value) {
                $parts = explode('_', $key);
                $output[$parts[0]][] = new SettingsDTO($key, $value);
            }
        }

        return collect($output);
    }
}
