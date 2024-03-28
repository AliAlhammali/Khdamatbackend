<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Admin\Users\Enums\UserAuthType;

trait AuthUser
{
    public function user(): object|null
    {
        if (pmsAuth()) return pmsAuth()->getUser();
        if (auth('api')->check()) return auth('api')->user();
        if (auth('sp_api')->check()) return auth('sp_api')->user();
        if (auth('customers_api')->check()) return auth('customers_api')->user();
        return auth()->user() ?? null;
    }

    public function userType(): string
    {
        if (pmsAuth())
            return UserAuthType::marafiq_user;

        if (auth('sp_api')->check())
            return UserAuthType::sp;

        if (auth('customers_api')->check())
            return UserAuthType::customer;

        //if (auth('api')->check())
        return UserAuthType::ops;
    }

    public function userId(): ?string
    {
        if (pmsAuth())
            return pmsAuth()->getUser()->id;

        if (auth('sp_api')->check())
            return auth('sp_api')->id();

        if (auth('customers_api')->check())
            return auth('customers_api')->id();
        return $this->user()->id ?? null;
    }

    public function userName(): ?string
    {
        return $this->user()->name ?? null;
    }

    public function userEmail(): ?string
    {
        return $this->user()->email ?? null;
    }

    public function userRuleType(): ?string
    {
        return $this->user()->type ?? null;
    }

    public function userObject(): array
    {
        return [
            'id' => $this->userId(),
            'name' => $this->userName()
        ];
    }

    public function addUserDataToObject(&$item): void
    {
        $item["add_by"] = $this->userType();
        $item["user"] = $this->userObject();
    }

    public function addUserDataToList(array $list): array
    {
        foreach ($list as &$item)
            $this->addUserDataToObject($item);
        return $list;
    }
}
