<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('admin.ManageAdmins.index', compact('admins'));
    }
    public function create()
    {

        $roles = Role::all(); // Fetch all available roles
        return view('admin.ManageAdmins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/admins', 'public');
        }

        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->image = $imagePath;
        $admin->password = Hash::make($request->input('password'));
        $admin->role_id = $request->input('role_id');
        $admin->save();
        // Assign role to the new admin

        // Fetch the role name from the role_id and assign the role to the new admin
        $role = Role::find($request->input('role_id'));
        $admin->assignRole($role->name);

        return redirect()->route('admins.create')->with('success', 'Admin created successfully!');
    }


    public function edit(Admin $admin)
    {
        $roles = Role::all(); // Fetch all available roles
        return view('admin.ManageAdmins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin
                ->id . ',id',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:204',
            'role_id' => 'required|exists:roles,id',
        ]);
        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/admins', 'public');
        }

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->image = $imagePath;
        $admin->password = Hash::make($request->input('password'));
        $admin->role_id = $request->input('role_id');
        $admin->save();
        // Assign role to the updated admin
        // Fetch the role name from the role_id and assign the role to the updated admin
        $role = Role::find($request->input('role_id'));
        $admin->assignRole($role->name);
        
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully!');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully!');
        }
}
