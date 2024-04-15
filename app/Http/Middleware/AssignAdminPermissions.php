<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AssignAdminPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Cari atau buat peran admin
            $adminRole = Role::where('name', 'admin')->first();
            if (!$adminRole) {
                $adminRole = Role::create(['name' => 'admin']);
            }

            // Dapatkan semua izin
            $permissions = Permission::all();

            // Tetapkan semua izin kepada peran admin
            $adminRole->syncPermissions($permissions);
        }

        return $next($request);
    }
}
