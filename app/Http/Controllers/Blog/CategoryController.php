<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\FrontendController;
use App\Http\Requests\BlogCategoryRequest;
use App\Models\Blog\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CategoryController extends FrontendController
{

    public function info(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $blogs = $category->blogs->toArray();

        $hot = array_pop($blogs);
 
        return $this->render('blog.category.info', [
            'category' => $category,
            'blogs'=> $blogs,
            "hot"=> $hot
        ]);
    }

  
}
