<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserService
{
    public function dataTable()
    {
        $data = UserProfile::whereHas('user.roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->with('user.roles')->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('role', function ($row) {
                $roles = $row->user->roles->pluck('name')->toArray();
                return implode(', ', $roles);
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="' . url("users", $row->user->id) . '/edit" name="edit" data-id="' . $row->user->id . '" class="editRole btn btn-warning btn-sm me-2"><i class="ti-pencil-alt"></i></a>';
                $actionBtn .= '<button type="button" name="delete" data-id="' . $row->user->id . '" class="deleteUser btn btn-danger btn-sm"><i class="ti-trash"></i></button>';
                return '<div class="d-flex">' . $actionBtn . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function create($data)
    {
        DB::beginTransaction();

        try {
            // create user
            $user = $this->createUser($data);

            // create user profile
            $this->createUserProfile($data, $user);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }
    }

    public function createUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // assign role
        $role = Role::find($data['role']);
        $user->assignRole($role);

        return $user;
    }

    public function createUserProfile($data, $user)
    {
        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'no_hp' => $data['no_hp'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat']
        ]);

        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/users'), $imageName);

            $userProfile->image = $imageName;
            $userProfile->save();
        }
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            // find user
            $user = User::findOrFail($id);

            // update user
            $this->updateUser($data, $user);

            // update user profile
            $this->updateUserProfile($data, $user);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil diubah.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal merubah data: ' . $e->getMessage()
            ];
        }
    }

    public function updateUser($data, $user)
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? bcrypt($data['password']) : $user->password,
        ]);

        // sync role
        if (isset($data['role'])) {
            $role = Role::find($data['role']);
            $user->syncRoles([$role->id]);
        }

        return $user;
    }

    public function updateUserProfile($data, $user)
    {
        $userProfile = $user->profile;

        $userProfile->update([
            'no_hp' => $data['no_hp'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat']
        ]);

        // update image
        if (isset($data['image'])) {
            if ($userProfile && $userProfile->image) {
                $oldImagePath = public_path('assets/images/users/' . $userProfile->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $data['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/users'), $imageName);

            $userProfile->image = $imageName;
            $userProfile->save();
        }

        return $userProfile;
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            // find user
            $user = User::find($id);

            // find user profile
            $userProfile = UserProfile::where('user_id', $id)->first();

            if ($user) {

                // delete user
                $this->deleteUser($user);

                // delete user profile
                $this->deleteUserProfile($userProfile);

                // delete user roles
                $user->roles()->detach();

                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Data berhasil dihapus.',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage(),
            ];
        }
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }

    public function deleteUserProfile($userProfile)
    {
        $imagePath = null;
        if ($userProfile->image) {
            $imagePath = public_path('assets/images/users/' . $userProfile->image);
        }

        $userProfile->delete();

        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
