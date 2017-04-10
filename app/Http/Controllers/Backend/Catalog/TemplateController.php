<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\TemplateReuqest;
use App\Models\Attribute\Attribute;
use App\Models\Product\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TemplateController extends BackendController
{
    public function index(Request $request)
    {
        $templates = Template::all();
        return $this->render('catalog.template.index', [
            'templates' => $templates
        ]);
    }

    public function attributes(Request $request) {
        $templateId = $request->get('id');
        return Template::with('attributes')->with('attributes.options')->find($templateId);
    }

    public function create(Request $request)
    {
        $attributes = Attribute::all();
        return $this->render('catalog.template.create',
            [
                'attributes'=> $attributes,
            ]);
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
