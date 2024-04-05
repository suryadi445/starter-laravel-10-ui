<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'suryadi.hhb@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $manager = User::create([
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $spv = User::create([
                'name' => 'spv',
                'email' => 'spv@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $role_admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
            $role_manager = Role::create(['name' => 'manager', 'guard_name' => 'web']);
            $role_spv = Role::create(['name' => 'spv', 'guard_name' => 'web']);

            $permissions = Permission::create(['name' => 'read role']);
            $permissions = Permission::create(['name' => 'create role']);
            $permissions = Permission::create(['name' => 'update role']);
            $permissions = Permission::create(['name' => 'delete role']);
            Permission::create(['name' => 'read konfigurasi']);

            $role_admin->givePermissionTo('read role');
            $role_admin->givePermissionTo('create role');
            $role_admin->givePermissionTo('update role');
            $role_admin->givePermissionTo('delete role');
            $role_admin->givePermissionTo('read konfigurasi');

            $admin->assignRole('admin');
            $manager->assignRole('manager');
            $spv->assignRole('spv');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
