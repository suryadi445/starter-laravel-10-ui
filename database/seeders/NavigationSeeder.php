<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Navigation::create([
            'name' => 'Konfigurasi',
            'url' => 'konfigurasi',
            'icon' => 'ti-settings',
            'main_menu' => null,
            'type_menu' => 'parent',
        ]);
        Navigation::create([
            'name' => 'Roles',
            'url' => 'konfigurasi/roles',
            'icon' => '',
            'main_menu' => 1,
            'type_menu' => 'child',
        ]);
        Navigation::create([
            'name' => 'Permissions',
            'url' => 'konfigurasi/permissions',
            'icon' => '',
            'main_menu' => 1,
            'type_menu' => 'child',
        ]);
        Navigation::create([
            'name' => 'Menu',
            'url' => 'konfigurasi/navigation',
            'icon' => '',
            'main_menu' => 1,
            'type_menu' => 'child',
        ]);
    }
}
