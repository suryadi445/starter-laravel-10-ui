<?php

use App\Models\Navigation;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->whereNull('main_menu')->get();
    }
}
