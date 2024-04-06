<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('konfigurasi/role');
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
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request['name'],
            'guard_name' => $request['guard_name'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
