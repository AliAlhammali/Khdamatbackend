<?php

namespace App\KhadamatTeck\Public\Settings\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Admin\Settings\Requests\ListSettingRequest;
use App\KhadamatTeck\Admin\Settings\Requests\ShowSettingRequest;
use App\KhadamatTeck\Admin\Settings\Requests\UpdateSettingRequest;
use App\KhadamatTeck\Admin\Settings\Services\SettingsService;
use App\KhadamatTeck\Base\Response;


class SettingsController extends Controller
{
    /**
     * @var settingsService $settingsService
     */
    private settingsService $settingsService;

    public function __construct(settingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function list(ListSettingRequest $request, $group = 'general'): Response
    {
        return $this->settingsService->list($request, $group);
    }

    public function show(ShowSettingRequest $request, $group = 'general',$key = null): Response
    {
        return $this->settingsService->find($request,$group,$key);
    }

    public function update(UpdateSettingRequest $request, $group = 'general'): Response
    {
        return $this->settingsService->update($request, $group);
    }

    public function forget(ShowSettingRequest $request, $group = null, $key = null): Response
    {
        return $this->settingsService->forget($group, $key);
    }

}
