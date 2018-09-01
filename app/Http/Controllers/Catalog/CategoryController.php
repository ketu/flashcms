<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\FrontendController;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CategoryController extends FrontendController
{

    public function index(Request $request)
    {
        $categories = Category::tree()->get();
        return $this->render('category.index', [
            'categories' => $categories
        ]);
    }

    public function info(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        return $this->render(
            'category.info',
            [
                'category'=> $category,

            ]
        );
    }

}
