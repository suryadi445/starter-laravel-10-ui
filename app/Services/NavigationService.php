<?php

namespace App\Services;

use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;

class NavigationService
{
    public function __construct()
    {
        //
    }

    public function dataTable()
    {
        $data = Navigation::select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('main_menu', function ($row) {
                if ($row->type_menu == 'child') {
                    return '<span class="px-3 py-1 badge bg-light text-primary">Child</span>';
                } else if ($row->type_menu == 'parent') {
                    return '<span class="px-3 py-1 badge bg-light text-primary">Parent</span>';
                } else {
                    return '<span class="px-3 py-1 badge bg-light text-primary">Single</span>';
                }
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                if (Gate::allows('update konfigurasi/roles')) {
                    $actionBtn .= '<button type="button" name="edit" data-id="' . $row->id . '" class="editRole btn btn-warning btn-sm me-2"><i class="ti-pencil-alt"></i></button>';
                }
                if (Gate::allows('delete konfigurasi/roles')) {
                    $actionBtn .= '<button type="button" name="delete" data-id="' . $row->id . '" class="deleteRole btn btn-danger btn-sm"><i class="ti-trash"></i></button>';
                }
                return '<div class="d-flex">' . $actionBtn . '</div>';
            })
            ->rawColumns(['action', 'main_menu'])
            ->make(true);
    }

    public function store(array $requestData)
    {
        if ($requestData['type_menu'] != 'child') {
            $requestData['main_menu'] = NULL;
        }

        try {
            // create permission
            $this->createPermission($requestData);

            // create menu navigation
            $navigation = Navigation::create($requestData);

            // pivot role table
            $navigation->roles()->attach($requestData['role']);

            // clear cache
            Artisan::call('permission:cache-reset');

            return [
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'role' => $navigation
            ];
        } catch (\Exception $e) {

            return [
                'status' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }
    }

    public function update($id, $requestData)
    {
        if ($requestData['type_menu'] != 'child') {
            $requestData['main_menu'] = NULL;
        }

        try {

            // check navigasi menu
            $navigation = Navigation::findOrFail($id);

            // update menu navigasi
            $navigation->update([
                'name' => $requestData['name'],
                'url' => $requestData['url'],
                'icon' => $requestData['icon'],
                'sort' => $requestData['sort'],
                'main_menu' => $requestData['main_menu'],
                'type_menu' => $requestData['type_menu'],
            ]);

            // synchronize role
            $navigation->roles()->sync($requestData['role']);

            // edit permission
            $this->editPermission($requestData);

            // clear cache
            Artisan::call('permission:cache-reset');

            return [
                'status' => true,
                'message' => 'Data berhasil diperbarui.'
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy(Navigation $navigation)
    {
        try {
            // type permission
            $permissions = ['read', 'create', 'update', 'delete'];

            foreach ($permissions as $permission) {
                $permissionName = $permission . ' ' . $navigation->name;

                // delete permission
                Permission::where('name', $permissionName)->delete();
            }

            // delete menu navigasi
            $navigation->delete();

            // synchronize role
            $navigation->roles()->sync([]);

            // clear cache
            Artisan::call('permission:cache-reset');

            return [
                'status' => true,
                'message' => 'Data berhasil dihapus.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ];
        }
    }

    public function createPermission($requestData)
    {

        if (!empty($requestData['url'])) {
            // type permission
            $permissions = ['read', 'create', 'update', 'delete'];

            foreach ($permissions as $permission) {
                // create permission
                Permission::create(['name' => $permission . ' ' . $requestData['url']]);
            }

            $roleIds = $requestData['role'];
            foreach ($roleIds as $roleId) {
                $role = Role::firstOrCreate(['id' => $roleId, 'guard_name' => 'web']);

                foreach ($permissions as $permission) {
                    // tambah permission untuk role
                    $role->givePermissionTo($permission . ' ' . $requestData['url']);
                }
            }
        }
    }

    public function editPermission($requestData)
    {
        if (!empty($requestData['url'])) {
            $url = $requestData['url'];

            // type permission
            $permissions = ['read', 'create', 'update', 'delete'];

            $roleIds = $requestData['role'];
            foreach ($roleIds as $roleId) {
                $role = Role::firstOrCreate(['id' => $roleId, 'guard_name' => 'web']);

                // Loop tipe permissions
                foreach ($permissions as $permission) {
                    // gabungkan permission dan url
                    $permissionName = $permission . ' ' . $url;

                    // cek permisson sudah ada untuk role nya
                    $existingPermission = $role->permissions()->where('name', $permissionName)->first();

                    if (!$existingPermission) {
                        // jika permission belum ada, tambahkan permission
                        $role->givePermissionTo($permissionName);
                    }
                }
            }

            $allRoles = Role::all();
            foreach ($allRoles as $role) {
                // cek apakah peran tidak termasuk dalam daftar peran yang dipilih
                if (!in_array($role->id, $roleIds)) {
                    foreach ($permissions as $permission) {
                        $permissionName = $permission . ' ' . $url;
                        // Hapus permissions dari roles yang tidak dipilih
                        $role->revokePermissionTo($permissionName);
                    }
                }
            }
        }
    }
}
