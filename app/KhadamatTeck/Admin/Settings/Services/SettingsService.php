<?php

namespace App\KhadamatTeck\Admin\Settings\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use Smartisan\Settings\Facades\Settings;

class SettingsService
{
    private $settings;

    public function __construct()
    {
        $this->settings = $this->getSetting();
    }

    private function getSetting()
    {
        return settings();
    }



    public function list($request, $group)
    {
        $data = settings()->group($group)->all();
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function find($request, $group, $key)
    {
        if($key){
            $data = settings()->group($group)->get($key);
            $data = [$key=>$data];
        }else{
            $data = settings()->group($group)->all();
        }

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function update($request, $group)
    {
        $this->settings->group($group)->set($request->settings);
        $newSetting = $this->settings->group($group)->all();
        return $this->response()
            ->setData($newSetting)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }



    protected function response(): Response
    {
        return (new Response());
    }

    public function forget(mixed $group, $key)
    {
        $settings = settings();
        if ($group) {
            if (!$key) {
                $all = $settings->group($group)->all();
                foreach ($all as $_key => $val) {
                    $settings->group($group)->forget($_key);
                }
            } else {
                $settings->group($group)->forget($key);
            }
        } else {
            $settings->forget($key);
        }

        return $this->response()
            ->setData($settings->group($group)->all())
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
