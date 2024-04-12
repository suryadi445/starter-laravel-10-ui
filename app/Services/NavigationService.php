<?php

namespace App\Services;

use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            return [
                'success' => true,
                'message' => 'Data berhasil disimpan.',
                'role' => $navigation
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
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
            $navigation = Navigation::findOrFail($id);

            $navigation->update([
                'name' => $requestData['name'],
                'url' => $requestData['url'],
                'icon' => $requestData['icon'],
                'sort' => $requestData['sort'],
                'main_menu' => $requestData['main_menu'],
                'type_menu' => $requestData['type_menu'],
            ]);

            return [
                'success' => true,
                'message' => 'Data berhasil diperbarui.'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy(Navigation $navigation)
    {
        try {
            $navigation->delete();
            return [
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ];
        }
    }

    public function createPermission($requestData)
    {
        if (!empty($requestData['url'])) {
            // create permission
            $permissions = [
                'read', 'create', 'update', 'delete'
            ];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission . ' ' . $requestData['url']]);
            }

            $roleIds = $requestData['role'];
            foreach ($roleIds as $roleId) {
                $role = Role::firstOrCreate(['id' => $roleId, 'guard_name' => 'web']);

                foreach ($permissions as $permission) {
                    $role->givePermissionTo($permission . ' ' . $requestData['url']);
                }
            }
        }
    }

    public function editPermission($requestData)
    {
        if (!empty($requestData['url'])) {
            $url = $requestData['url'];
            $permissions = ['read', 'create', 'update', 'delete'];

            // Loop through each role
            $roleIds = $requestData['role'];
            // foreach ($roleIds as $roleId) {
            //     $role = Role::firstOrCreate(['id' => $roleId, 'guard_name' => 'web']);

            //     // Loop through permissions
            //     foreach ($permissions as $permission) {
            //         $permissionName = $permission . ' ' . $url;

            //         // Check if permission already exists for the role
            // $existingPermission = $role->permissions()->where('name', $permissionName)->first();

            //         dd($existingPermission);

            $roleid = $requestData['role'];
            $role = Role::firstOrCreate(['id' => $roleid, 'guard_name' => 'web']);

            // give permission
            $role->givePermissionTo('read ' . $requestData['url']);
            $role->givePermissionTo('create ' . $requestData['url']);
            $role->givePermissionTo('update ' . $requestData['url']);
            $role->givePermissionTo('delete ' . $requestData['url']);
        }
    }
}
