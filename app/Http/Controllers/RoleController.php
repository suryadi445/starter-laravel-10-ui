<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\RoleService;


class RoleController extends Controller
{

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->roleService->dataTable();
        }

        return view('konfigurasi.role');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('konfigurasi.role-form', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->only(['name', 'guard_name']);
        $response = $this->roleService->update($id, $requestData);

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $result = $this->roleService->destroy($role);
        return response()->json($result);
    }
}
