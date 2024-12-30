<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{
    public function create(){
        $permissions = Permission::all();
        return view('admin.Roles.createPermission', compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'permission_name' => 'required|string|max:255',
        ]);
        
        Permission::firstOrCreate(['name' => $request->permission_name]);
        
        return redirect()->back()->with('success', 'Permission added successfully!');
    }
}
