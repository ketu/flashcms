<?php

namespace App\Http\Controllers\Blog;

use App\FlashCMS\Helpers\Image;
use App\FlashCMS\Helpers\FlashCMS;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\BlogRequest;
use App\Models\Blog\Blog;
use App\Models\Blog\Category;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends FrontendController
{

    public function info(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        return $this->render('blog.frame', [
            'blog' => $blog
        ]);
    }

}
