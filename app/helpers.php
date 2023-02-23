<?php

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser()
    {
        return auth()->guard('accounts')->user();
    }
}

if (!function_exists('authCheck')) {
    function authCheck()
    {
        return auth()->guard('accounts')->check();
    }
}

if (!function_exists('getAccountInfo')) {
    function getAccountInfo()
    {
        return getLoggedInUser()->accountable;
    }
}

if (!function_exists('isAccountType')) {
    function isAccountType($accountType)
    {
        return getLoggedInUser()->accountable_type == $accountType;
    }
}

if (!function_exists('isMemberLogged')) {
    function isMemberLogged()
    {
        return getLoggedInUser() && isAccountType(\App\Models\Member::class);
    }
}

if (!function_exists('isManagerLogged')) {
    function isManagerLogged()
    {
        return getLoggedInUser() && isAccountType(\App\Models\Manager::class);
    }
}

if (!function_exists('getCart')) {
    function getCart()
    {
        return isMemberLogged()
            ? (getAccountInfo()->cart ? getAccountInfo()->cart->cart_content : [])
            : collect(\Cart::content()->all(), function ($item) {
                return collect($item)->toArray();
            })->toArray();
    }
}

if (!function_exists('getCartTotal')) {
    function getCartTotal()
    {
        return isMemberLogged() ? (!empty(getCart()) ? number_format(getAccountInfo()->cart->sub_total, 0, ',', '.') : 0) : \Cart::subtotal(0, ',', '.');
    }
}

if (!function_exists('getProductImageInCart')) {
    function getProductImageInCart($productId)
    {
        $product = \App\Models\Product::find($productId);
        return $product->feature_image_path ?? null;
    }
}

if (!function_exists('getCombinations')) {
    function getCombinations($arrays)
    {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}

if (!function_exists('getCombinations')) {
    function getCombinations($arrays)
    {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission($permission)
    {
        if (getLoggedInUser()->checkPermissionAccess($permission) || getAccountInfo()->hasRole('Admin')) {
            return true;
        }
        return false;
    }
}

