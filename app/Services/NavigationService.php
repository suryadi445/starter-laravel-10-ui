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
use Illuminate\Support\Facades\DB;

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
                if (Gate::allows('update roles')) {
                    $actionBtn .= '<button type="button" name="edit" data-id="' . $row->id . '" class="editRole btn btn-warning btn-sm me-2"><i class="ti-pencil-alt"></i></button>';
                }
                if (Gate::allows('delete roles')) {
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
            DB::beginTransaction();

            // create permission
            $this->createPermission($requestData);

            // create menu navigation
            $navigation = Navigation::create($requestData);

            // pivot role table
            $navigation->roles()->attach($requestData['role']);

            // clear cache
            Artisan::call('permission:cache-reset');

            DB::commit();


            return [
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'role' => $navigation
            ];
        } catch (\Exception $e) {

            DB::rollBack();

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
            DB::beginTransaction();

            $navigation = Navigation::findOrFail($id);

            // update navigation role
            $navigation->roles()->sync($requestData['role']);

            // update permission
            $this->editPermission($requestData, $navigation);

            // update menu
            $navigation->update($requestData);

            // clear cache
            Artisan::call('permission:cache-reset');

            DB::commit();

            return [
                'status' => true,
                'message' => 'Data berhasil diperbarui.'
            ];
        } catch (Exception $e) {

            DB::rollBack();

            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy(Navigation $navigation)
    {
        try {
            DB::beginTransaction();
            // type permission
            $permissions = ['read', 'create', 'update', 'delete'];

            foreach ($permissions as $permission) {
                $url = $navigation->url;

                $permissionName = $permission . ' ' . $url;

                // delete permission
                Permission::where('name', $permissionName)->delete();
            }

            // delete menu navigasi
            $navigation->delete();

            // synchronize role
            $navigation->roles()->sync([]);

            // clear cache
            Artisan::call('permission:cache-reset');

            DB::commit();

            return [
                'status' => true,
                'message' => 'Data berhasil dihapus.'
            ];
        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ];
        }
    }

    public function createPermission($requestData)
    {
        if (!empty($requestData['url'])) {

            $permissions = ['read', 'create', 'update', 'delete'];
            $url = $requestData['url'];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission . ' ' . $url]);
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

    protected function editPermission($requestData, $navigation)
    {
        $roleIds            = $requestData['role'];
        $url                = $requestData['url'];
        $oldUrl             = $navigation->url;
        $allRoles           = Role::whereIn('id', $roleIds)->get();
        $newPermissions     = ["read", "create", "update", "delete"];

        $permissions = [];
        foreach ($newPermissions as $permission) {

            $oldPermissions = Permission::where('name', $permission . " " . $oldUrl)->first();

            if ($oldPermissions) {
                $oldPermissions->delete();
            }

            $newCreatePermissions   = $permission . ' ' . $url;
            $permissions[]          = $newCreatePermissions;

            Permission::create(['name' => $newCreatePermissions]);

            foreach ($allRoles as $role) {
                $role->givePermissionTo($permissions);
            }
        }
    }
}
