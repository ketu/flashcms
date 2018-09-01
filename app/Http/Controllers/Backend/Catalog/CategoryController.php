<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CategoryController extends BackendController
{

    public function index(Request $request)
    {
        $categories = Category::tree()->get();
        return $this->render('catalog.category.index', [
            'categories' => $categories
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::tree()->get();

        return $this->render('catalog.category.create', [
            'categories' => $categories
        ]);
    }

    public function save(CategoryRequest $request)
    {
        try {
            $currentLocale = app()->getLocale();
            $category = new Category();
            $category->translateOrNew($currentLocale)->name = $request->get('name');
            $parentId = $request->get('parent_id', null);
            $category->status = $request->get('status', false);

            if (!is_null($parentId)) {
                $parent = Category::findOrFail($parentId);
                $category->parent_id = $parent->id;
            }

            $category->save();
            return redirect()->route('category.edit', ['id' => $category->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function edit(Request $request, $id)
    {


        $category = Category::findOrFail($id);

        $categories = Category::tree()->get();

        $nodes = $category->renderTree();
        $children = [];
        foreach ($nodes as $node) {
            $children[] = $node->id;
        }

        return $this->render('catalog.category.edit', [
            'category' => $category,
            'children'=>$children,
            'categories'=> $categories
        ]);
    }


    public function update(CategoryRequest $request)
    {
        try {
            $id = $request->get('id');

            $category = Category::findOrFail($id);

            $currentLocale = app()->getLocale();

            $category->translateOrNew($currentLocale)->name = $request->get('name');
            $category->status = $request->get('status', false);

            $parentId = $request->get('parent_id', null);
            if ($category->parent_id != $parentId) {

                $category->parent_id = $parentId;
            }

            $category->save();

            return redirect()->route('category')->with('success', 'notice.success');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }


    }

    public function delete(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('category')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

    }

    public function rebuild(Request $request)
    {
        try{
            Category::rebuild();
            return redirect()->route('category')->with('success', 'notice.success');
        }catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());

        }
    }
}
