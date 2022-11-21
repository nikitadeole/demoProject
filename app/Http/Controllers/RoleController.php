<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use App\Models\Permission;


class RoleController extends Controller
{
    public function index() {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function store() {
        request()->validate([
            'name' => ['required']
        ]);
        Role::create([
            'name' => Str::lower(request('name')),
            'slug' => Str::lower(request('name'))
            ]
        );

        return back();
    }

    public function destroy(Role $role) {
        $role->delete();
        session()->flash('role-deleted', "Role $role->name has been deleted");
        return back();
    }

    public function edit(Role $role) {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
            ]
        );
    }

    public function update(Role $role) {
        request()->validate([
            'name' => ['required']
        ]);

        $role->name = Str::lower(request('name'));
        $role->slug = Str::lower(request('name'));

        if($role->isDirty('name')) {
            session()->flash('role-updated', "Role $role->name has been updated");
            $role->save();
        }
        else {
            session()->flash('role-updated', "Nothing to update");
        }
        return back();

    }

    public function attach(Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach(Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }
}
