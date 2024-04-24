<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\PermissionRequest;
use App\Models\Role;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->middleware('can:read permissions');
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Permission';
        if ($request->ajax()) {
            return $this->permissionService->dataTable();
        }

        return view('konfigurasi.permission', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $result = $this->permissionService->createPermission($request->all());

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($roleId = null)
    {
        $permissions = $this->permissionService->getRolePermission($roleId);

        return view('konfigurasi.permission-form', compact('permissions', 'roleId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Permission $permission)
    {
        $role = Role::findOrFail($request->input('role_id'));

        $result = $this->permissionService->destroy($permission, $role);
        return response()->json($result);
    }
}
