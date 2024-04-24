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
            $user = $this->createUser();

            $this->createUserProfile();

            $this->createRole($user);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function createRole($user)
    {
        $role_admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role_manager = Role::create(['name' => 'manager', 'guard_name' => 'web']);
        $role_spv = Role::create(['name' => 'spv', 'guard_name' => 'web']);

        $permissions = ['read', 'create', 'update', 'delete'];

        foreach ($permissions as $permission) {
            $permissionKonfig =  $permission . ' ' . 'konfigurasi';
            $permissionPerm =  $permission . ' ' . 'permissions';
            $permissionRole =  $permission . ' ' . 'roles';
            $permissionNav =  $permission . ' ' . 'navigation';
            $permissionUser =  $permission . ' ' . 'users';
            // $permissionUserCreate =  $permission . ' ' . 'users/create';
            // $permissionUserUpdate =  $permission . ' ' . 'users/update';
            // $permissionUserDelete =  $permission . ' ' . 'users/delete';

            Permission::firstOrCreate(['name' => $permissionKonfig]);
            Permission::firstOrCreate(['name' => $permissionPerm]);
            Permission::firstOrCreate(['name' => $permissionRole]);
            Permission::firstOrCreate(['name' => $permissionNav]);
            Permission::firstOrCreate(['name' => $permissionUser]);
            // Permission::firstOrCreate(['name' => $permissionUserCreate]);
            // Permission::firstOrCreate(['name' => $permissionUserUpdate]);
            // Permission::firstOrCreate(['name' => $permissionUserDelete]);

            $role_admin->givePermissionTo($permissionKonfig);
            $role_admin->givePermissionTo($permissionPerm);
            $role_admin->givePermissionTo($permissionRole);
            $role_admin->givePermissionTo($permissionNav);
            $role_admin->givePermissionTo($permissionUser);
            // $role_admin->givePermissionTo($permissionUserCreate);
            // $role_admin->givePermissionTo($permissionUserUpdate);
            // $role_admin->givePermissionTo($permissionUserDelete);
        }

        $user['admin']->assignRole('admin');
        $user['manager']->assignRole('manager');
        $user['spv']->assignRole('spv');
    }

    public function createUser()
    {
        $result['admin'] = User::create([
            'name' => 'Admin Suryadi',
            'email' => 'suryadi.hhb@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $result['manager'] = User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $result['spv'] = User::create([
            'name' => 'spv',
            'email' => 'spv@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        return $result;
    }

    public function createUserProfile()
    {
        // Buat profil untuk Admin
        $admin = User::where('email', 'suryadi.hhb@gmail.com')->first();
        if ($admin) {
            $admin->profile()->create([
                'no_hp' => '089678468651',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1991-04-05',
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jl. H. Gadung no.20, Pondok Ranji, Ciputat Timur, Tangerang Selatan, Banten',
            ]);
        }

        // Buat profil untuk Manager
        $manager = User::where('email', 'manager@gmail.com')->first();
        if ($manager) {
            $manager->profile()->create([
                'no_hp' => '08123456799',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1994-01-01',
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jalan Bogor Raya No. 19',
            ]);
        }

        $spv = User::where('email', 'spv@gmail.com')->first();
        if ($spv) {
            $spv->profile()->create([
                'no_hp' => '08123456789',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1990-11-21',
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jalan Bandung Utara No. 123',
            ]);
        }
    }
}
