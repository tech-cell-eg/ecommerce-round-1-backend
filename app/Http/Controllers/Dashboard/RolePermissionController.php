<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.Roles.index', compact('roles', 'permissions'));
    }


    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.Roles.createRole', compact('roles', 'permissions'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);
        
        Role::firstOrCreate(['name' => $request->role_name]);
        
        return redirect()->back()->with('success', 'Role added successfully!');
    }


}
