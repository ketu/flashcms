<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Backend\BackendController;
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

    public function save(TemplateReuqest $request)
    {
        try {
            $currentLocale = app()->getLocale();
            $template = new Template();
            $template->translateOrNew($currentLocale)->name = $request->get('name');
            DB::beginTransaction();
            $template->save();
            $template->attributes()->attach($request->get('attributes'));
            DB::commit();

            return redirect()->route('template.edit', ['id' => $template->id])->with('success', 'notice.success');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }


    public function edit(Request $request, $id)
    {
        $template = Template::findOrFail($id);

        $attributes = Attribute::all();
        return $this->render('catalog.template.edit', [
            'template' => $template,
            'attributes'=> $attributes,
        ]);
    }

    public function update(TemplateReuqest $request)
    {
        try {
            $id = $request->get('id');
            $template = Template::findOrFail($id);
            $currentLocale = app()->getLocale();
            $template->translateOrNew($currentLocale)->name = $request->get('name');

            DB::beginTransaction();
            $template->save();
            $template->attributes()->detach($request->get('attributes'));
            $template->attributes()->attach($request->get('attributes'));
            DB::commit();
            return redirect()->route('template')->with('success', 'notice.success');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $template = Template::findOrFail($id);
            $template->delete();
            return redirect()->route('template')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
