<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function index()
    {
        $roles = Role::with('users')->get();
        return view('admin.pages.role.index', compact('roles'));
    }



    public function create()
    {
       return  view('admin.pages.role.create');
    }




    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = new Role();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('roles.create')->with('success', 'Role Created success !');

    }



    public function show($id)
    {
        $role = Role::with(['users.profile'])->findOrFail($id);
        return  view('admin.pages.role.show', compact('role'));
    }



    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return  view('admin.pages.role.edit', compact('role'));
    }



    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('roles.edit', $role->id)->with('success', 'Role Updated success !');
    }



    public function destroy($id)
    {


        $role = Role::findOrFail($id);
        if ($role){
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Role Deleted success !');
        }

    }
}
