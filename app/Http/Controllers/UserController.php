<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('can:read users');
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $title = 'Users';
        if ($request->ajax()) {
            return $this->userService->datatable();
        }

        return view('users.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah User';
        return view('users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $result = $this->userService->create($request->all());

        if ($result['success']) {
            return redirect()->route('users.index')->with('success', $result['message']);
        } else {
            return back()->withInput()->with('error', $result['message']);
        }
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
    public function edit(string $id)
    {
        $title = 'Edit User';
        $user = $this->userService->getById($id);

        return view('users.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->userService->update($request->all(), $id);

        if ($result['success']) {
            return redirect()->route('users.index')->with('success', $result['message']);
        } else {
            return back()->withInput()->with('error', $result['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->userService->delete($id);

        return response()->json($result);
    }
}
