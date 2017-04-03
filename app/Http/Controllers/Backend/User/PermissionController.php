<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\PermissionRequest;
use App\Models\Auth\Permission;
use Illuminate\Http\Request;

class PermissionController extends BackendController
{
    public function index(Request $request)
    {
        $permissions = Permission::all();
        return $this->render('user.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create(Request $request)
    {
        return $this->render('user.permission.create');
    }

    public function save(PermissionRequest $request)
    {
        try {
            $permission = new Permission();
            $permission->name = $request->get('name');
            $permission->display_name = $request->get('display_name');
            $permission->description = $request->get('description');
            $permission->save();
            return redirect()->route('permission.edit', ['id' => $permission->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        return $this->render('user.permission.edit', [
            'permission' => $permission
        ]);

    }

    public function update(PermissionRequest $request)
    {
        try {
            $id = $request->get('id');
            $permission = Permission::findOrFail($id);
            $permission->name = $request->get('name');
            $permission->display_name = $request->get('display_name');
            $permission->description = $request->get('description');
            $permission->save();
            return redirect()->route('permission')->with('success', 'notice.success');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try{
            $permission = Permission::findOrFail($id);
            $permission->delete();
            return redirect()->route('permission')->with('success', 'notice.success');

        }catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
