<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Cms\Page;
use Illuminate\Http\Request;

class PageController extends BackendController
{
    
    public function index(Request $request)
    {
        $pages = Page::all();
        return $this->render('cms.page.index', [
            'pages'=> $pages
        ]);
    }

    
    public function edit(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return $this->render('cms.page.edit', [
            'page'=> $page
        ]);
    }

    
    public function save(Request $request)
    {
    }

    public function delete(Request $request, $id)
    {
    }
}
