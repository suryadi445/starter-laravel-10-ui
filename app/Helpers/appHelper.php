<?php

use App\Models\Navigation;
use App\Models\Role;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->orderBy('sort', 'desc')->get();
    }
}

if (!function_exists('getParentMenus')) {
    function getParentMenus($url)
    {
        $menu = Navigation::where('url', $url)->first();
        if ($menu) {
            $parentMenu = Navigation::select('name')->where('id', $menu->main_menu)->first();
            return $parentMenu->name ?? '';
        }
        return '';
    }
}


if (!function_exists('getRoles')) {
    function getRoles()
    {
        return Role::where('name', '!=', 'admin')->get();
    }
}
