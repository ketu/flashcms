<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\PageRequest;
use App\Models\Cms\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends BackendController
{

    public function index(Request $request)
    {
        $pages = Page::all();
        return $this->render('cms.page.index', [
            'pages' => $pages
        ]);
    }

    public function create(Request $request)
    {

        return $this->render('cms.page.create');
    }

    public function save(PageRequest $request)
    {
        try {
            $currentLocale = app()->getLocale();
            $page = new Page();
            $page->slug = $request->get('slug');
            $page->status = $request->get('status', false);
            $page->translateOrNew($currentLocale)->name = $request->get('name');
            $page->translateOrNew($currentLocale)->content = $request->get('content');
            $page->first_create_user = Auth::id();
            $page->save();
            return redirect()->route('cms.page.edit', ['id' => $page->id])->with('success', 'notice.success');
        }catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function edit(Request $request, $id)
    {

        $page = Page::findOrFail($id);

        return $this->render('cms.page.edit', [
            'page' => $page
        ]);
    }


    public function update(PageRequest $request)
    {
        try {
            $id = $request->get('id');
            $page = Page::findOrFail($id);
            $currentLocale = app()->getLocale();
            $page->slug = $request->request->get('slug');
            $page->status = $request->request->get('status', false);
            $page->translateOrNew($currentLocale)->name = $request->get('name');
            $page->translateOrNew($currentLocale)->content = $request->get('content');
            $page->last_update_user = Auth::id();;
            $page->save();

            return redirect()->route('cms.page')->with('success', 'notice.success');

        }catch (\Exception $e) {
            echo $e->getMessage();
            exit();
            return redirect()->back()->withInput()->with('failed', 'not success');

        }



    }

    public function delete(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);
            $page->delete();
            return redirect()->route('cms.page')->with('success', 'notice.success');
        }catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

    }
}
