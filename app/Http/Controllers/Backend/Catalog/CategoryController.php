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

        $category = Category::find(61);

        $category->parent_id = 63;

        $category->save();


        /*$category = new Category();
        $category->name = '11111';

        $category->save();

        $category2 = new Category();
        $category2->name = '22222';
        $category2->parent_id = $category->id;
        $category2->save();

        $child = new Category();
        $child->name = '33333';
        $child->parent_id = $category2->id;

        $child->save();
        $child2 = new Category();
        $child2->name = '44444';
        $child2->parent_id = $child->id;

        $child2->save();


        $category = new Category();
        $category->name = 'XXXXX';

        $category->save();*/
    }
}
