<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\RoleRequest;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends BackendController
{
    public function index(Request $request)
    {
        $roles = Role::all();
        return $this->render('user.role.index', [
            'roles' => $roles
        ]);
    }

    public function create(Request $request)
    {
        $permissions = Permission::all();
        return $this->render('user.role.create', [
            'permissions'=> $permissions
        ]);
    }

    public function save(RoleRequest $request)
    {
        try {

            $role = new Role();

            $role->name = $request->get('name');
            $role->display_name = $request->get('display_name');
            $role->description = $request->get('description');

            DB::beginTransaction();

            $role->save();

            $role->perms()->attach($request->get('permission'));

            DB::commit();

            return redirect()->route('role.edit', ['id' => $role->id])->with('success', 'notice.success');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function edit(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return $this->render('user.role.edit', [
            'role' => $role,
            'permissions'=> $permissions
        ]);

    }

    public function update(RoleRequest $request)
    {
        try {
            $id = $request->get('id');
            $role = Role::findOrFail($id);
            $role->name = $request->get('name');
            $role->display_name = $request->get('display_name');
            $role->description = $request->get('description');
            DB::beginTransaction();
            $role->perms()->attach($request->get('permission'));
            $role->save();
            DB::commit();
            return redirect()->route('role')->with('success', 'notice.success');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }


    }

    public function delete(Request $request, $id)
    {
        try{
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->route('user')->with('success', 'notice.success');

        }catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
