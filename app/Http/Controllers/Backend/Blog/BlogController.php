<?php

namespace App\Http\Controllers\Backend\Blog;

use App\FlashCMS\Helpers\Image;
use App\FlashCMS\Helpers\FlashCMS;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\BlogRequest;
use App\Models\Blog\Blog;
use App\Models\Blog\Category;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends BackendController
{

    public function index(Request $request)
    {
        $blogs = Blog::translatedIn()->get();
        return $this->render('blog.index', [
            'blogs' => $blogs
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::tree()->get();
 
        return $this->render('blog.create', [
            'categories' => $categories
        ]);
    }


    public function save(BlogRequest $request)
    {
        try {

            $currentLocale = app()->getLocale();
 

            $blog = new Blog();
            $blog->translateOrNew($currentLocale)->name = $request->get('name');
            $blog->translateOrNew($currentLocale)->description = $request->get('content');
 
            $blog->slug = $request->get('slug');
     

            $categories = $request->get('categories', []);
            $blog->status = $request->get('status', false);

            if ($request->file('thumb')) {
                $destFolder = FlashCMS::getLogoUploadFolder();
                $path = Storage::disk('gallery')->putFile($destFolder, $request->file('thumb'));
                $blog->thumb = $path;
            }

            DB::beginTransaction();

            $blog->save();

            $blog->categories()->detach();
            $blog->categories()->attach($categories);


            DB::commit();


            return redirect()->route('blog.edit', ['id' => $blog->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function edit(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);

        $categories = Category::tree()->get();
  


        $categoryIds = [];
        foreach ($blog->categories as $category) {
            $categoryIds[] = $category->id;
        }

        
        return $this->render('blog.edit', [
            'blog' => $blog,
            'categories' => $categories,
            "categoryIds"=> $categoryIds     
        ]);
    }


    public function update(BlogRequest $request)
    {
        try {
           
            $id = $request->get('id');

            $blog = Blog::findOrFail($id);

            $currentLocale = app()->getLocale();

            $blog->translateOrNew($currentLocale)->name = $request->get('name');

            $blog->translateOrNew($currentLocale)->description = $request->get('content');

 
            $blog->slug = $request->get('slug');
          
            $blog->status = $request->get('status', false);

            if ($request->file('thumb')) {
                $destFolder = FlashCMS::getLogoUploadFolder();
                $path = Storage::disk('gallery')->putFile($destFolder, $request->file('thumb'));
                $blog->thumb = $path;
            }
            // categories
            $categories = $request->get('categories', []);
            $blog->categories()->detach();
            $blog->categories()->attach($categories);
 
            $blog->save();

            return redirect()->route('blog')->with('success', 'notice.success');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return redirect()->route('blog')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
