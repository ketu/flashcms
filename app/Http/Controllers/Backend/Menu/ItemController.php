<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\MenuItemRequest;
use App\Models\Menu\Item;
use App\Models\Menu\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ItemController extends BackendController
{
    public function index(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);

        $items = Item::tree()->where('menu_id', $menuId)->get();
        return $this->render('menu.item.index', [
            'items' => $items,
            'menu' => $menu
        ]);
    }

    public function create(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $items = Item::tree()->where('menu_id', $menuId)->get();

        return $this->render('menu.item.create', [
            'menu' => $menu,
            'items' => $items,
        ]);
    }

    public function save(MenuItemRequest $request)
    {
        try {
            $menu = Menu::findOrFail($request->get('menuId'));

            $item = new Item();

            $currentLocale = app()->getLocale();
            $item->translateOrNew($currentLocale)->name = $request->get('name');
            $item->link = $request->get('link');
            $item->status = $request->get('status', false);
            $item->menu_id = $menu->id;
            $item->parent_id = $request->get('parent_id', null);

            $item->save();
            return redirect()->route('menu.item.edit', ['id' => $item->id])->with('success', 'notice.success');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }


    public function edit(Request $request, $id)
    {

        $item = Item::findOrFail($id);

        $items = Item::tree()->where('menu_id', $item->menu->id)->get();

        $childItems = $item->renderTree()->get();
        $children = [];
        foreach($childItems as $child) {
            $children[] = $child->id;
        }

        return $this->render('menu.item.edit', [
            'items' => $items,
            'item'=> $item,
            'children'=> $children
        ]);

    }

    public function update(MenuItemRequest $request)
    {
        try{

            $item = Item::findOrFail($request->get('id'));
            $currentLocale = app()->getLocale();
            $item->translateOrNew($currentLocale)->name = $request->get('name');
            $item->link = $request->get('link');
            $item->status = $request->get('status', false);
            $item->parent_id = $request->get('parent_id');
            $item->save();
            return redirect()->route('menu.item', ['menuId'=> $item->menu->id])->with('success', 'notice.success');

        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }


}
