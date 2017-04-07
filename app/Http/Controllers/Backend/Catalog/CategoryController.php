<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CategoryController extends BackendController
{
    public function index(Request $request)
    {
        $category = new Category();
        $category->name = 'asdfsad';

        $category->save();

        $category = new Category();
        $category->name = 'asdfsad33423432';

        $category->save();

        $child = new Category();
        $child->name = 'asdfsad';
        $child->parent_id = $category->id;

        $child->save();

    }
}
