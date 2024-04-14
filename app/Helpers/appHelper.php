<?php

use App\Models\Navigation;
use App\Models\Role;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->orderBy('sort', 'desc')->get();
    }
}

if (!function_exists('getRoles')) {
    function getRoles()
    {
        return Role::where('name', '!=', 'admin')->get();
    }
}

if (!function_exists('getBreadcrumbs')) {
    function getBreadcrumbs($route, $params = [])
    {
        $segments = [];

        // Tambahkan segmen "Home"
        $segments[] = ['url' => route('home'), 'text' => 'Home'];

        // Tambahkan segmen tambahan berdasarkan route dan parameter yang diberikan
        switch ($route) {
            case 'library':
                $segments[] = ['url' => route('library'), 'text' => 'Library'];
                break;
            case 'permissions.index':
                $segments[] = ['url' => route('permissions.index'), 'text' => 'Permissions'];
                break;
                // Tambahkan case tambahan untuk setiap route yang Anda perlukan
            default:
                // Jika tidak ada route yang cocok, tidak menambahkan segmen tambahan
                break;
        }

        // Tambahkan segmen terakhir (segmen aktif)
        $segments[] = ['text' => 'Create'];

        return $segments;
    }
}
