<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function index() {
        $permissions = Permission::all()->groupBy('guard_name');
        $guards = config('app.guards');
       return view('admin.roles.index' , compact('permissions' , 'guards'));
    }


    function store(Request $request) {

       $role = Role::firstOrCreate([
           'name' => $request->name ,
           'description' => $request->description ,
           'guard_name' => $request->guard ,
        ]);

        foreach($request->permissions as $perm){
            $permission = Permission::query()->where('id' , $perm)->first();
            $role->givePermissionTo($permission);
        }

        return response()->json();
    }


}
