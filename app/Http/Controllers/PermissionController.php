<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        return view('admin.permissions.index', 
        [
            'permissions' => Permission::all()
        ]);
    }

    public function store() {
        request()->validate([
            'name' => ['required']
            ]
        );

        Permission::create([
            'name' => Str::lower(request('name')),
            'slug' => Str::lower(request('name'))
        ]);

        return back();
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        session()->flash('permission-deleted', "Role $permission->name has been deleted");

        return back();

    }

   public function edit(Permission $permission) {
       return view('admin.permissions.edit', ['permission' => $permission]);
   }

   public function update(Permission $permission) {
       request()->validate([
           'name' => ['required']
       ]);

       $permission->name =  Str::lower(request('name'));
       $permission->slug = Str::lower(request('name'));
       if($permission->isDirty('name')) {
            session()->flash('permission-updated', "Permission $permission->name has been updated");
            $permission->save();
        }
        else {
            session()->flash('permission-updated', "Nothing to update");
        }
        return back();
    }
}
