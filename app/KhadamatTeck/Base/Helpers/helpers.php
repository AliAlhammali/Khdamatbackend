<?php

if (!function_exists('AdminAuth')) {

    function AdminAuth()
    {
        return auth('admin');
    }
}

if (!function_exists('MerchantAuth')) {

    function MerchantAuth()
    {
        return auth('merchant');
    }
}

if (!function_exists('SPAuth')) {

    function SPAuth()
    {
        return auth('service-provider');
    }
}
