<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\UserRequest;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BackendController
{

    public function index(Request $request)
    {
        $users = User::all();
        return $this->render('user.index', [
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {

        $roles = Role::all();
        return $this->render('user.create', ['roles' => $roles]);
    }

    public function save(UserRequest $request)
    {

        try {


            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->status = $request->get('status', false);

            $user->password = bcrypt($request->get('password'));
            $user->nickname = $request->get('nickname');

            DB::beginTransaction();

            $user->save();

            $user->roles()->attach($request->get('roles'));

            DB::commit();


            return redirect()->route('user.edit', ['id' => $user->id])->with('success', 'notice.success');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function edit(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $roles = Role::all();
        return $this->render('user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);

    }

    public function update(UserRequest $request)
    {
        try {
            $id = $request->get('id');
            $user = User::findOrFail($id);
            $user->name = $request->get('name');
            $user->nickname = $request->get('nickname');
            $user->email = $request->get('email');
            $user->status = $request->get('status', false);
            $user->password = bcrypt($request->get('password'));


            DB::beginTransaction();

            $user->roles()->attach($request->get('roles'));

            $user->save();

            DB::commit();


            return redirect()->route('user')->with('success', 'notice.success');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function delete(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user')->with('success', 'notice.success');

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

}
