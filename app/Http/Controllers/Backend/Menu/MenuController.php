<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\MenuRequest;
use App\Models\Menu\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MenuController extends BackendController
{
    public function index(Request $request)
    {
        $menus = Menu::all();
        return $this->render('menu.index', [
            'menus' => $menus
        ]);
    }


    public function create(Request $request)
    {

        return $this->render('menu.create');
    }

    public function save(MenuRequest $request)
    {
        try {
            $menu = new Menu();
            $menu->name = $request->get('name');
            $menu->code = $request->get('code');

            $menu->save();

            return redirect()->route('menu.edit', ['id' => $menu->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }


    public function edit(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);


        return $this->render('menu.edit', [
            'menu' => $menu
        ]);
    }

    public function update(MenuRequest $request)
    {
        try {
            $id = $request->get('id');
            $menu = Menu::findOrFail($id);
            $menu->name = $request->get('name');
            $menu->code = $request->get('code');
            $menu->save();
            return redirect()->route('menu')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return redirect()->route('menu')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
