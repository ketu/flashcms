<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\FlashCMS\Image;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\ProductRequest;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\Template;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends BackendController
{

    public function index(Request $request)
    {
        $products = Product::all();
        return $this->render('catalog.product.index', [
            'products' => $products
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::tree();
        $templates = Template::all();


        //$attributeTypes = Config::get('flashcms.attribute.type');
        $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');

        $attributeTypes = [];
        foreach(Config::get('flashcms.attribute.type') as $type=> $name) {
            $attributeTypes[$type] = $type;
        }

        return $this->render('catalog.product.create', [
            'categories' => $categories,
            'templates'=> $templates,
            'attributeTypes'=> \json_encode($attributeTypes),
            'attributeTypeHasOption'=> \json_encode($attributeTypeHasOption)
        ]);
    }


    public function save(ProductRequest $request)
    {
        try {


            $currentLocale = app()->getLocale();
            $product = new Product();
            $product->translateOrNew($currentLocale)->name = $request->get('name');
            $product->translateOrNew($currentLocale)->description = $request->get('content');
            $product->sku = $request->get('sku');
            $product->slug = $request->get('slug');

            $categories = $request->get('categories', []);
            $product->status = $request->get('status', false);
            DB::beginTransaction();
            $product->save();

            $product->categories()->attach($categories);
            DB::commit();


            return redirect()->route('product.edit', ['id' => $product->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function edit(Request $request, $id)
    {


        $product = Product::findOrFail($id);

        $categories = Category::tree();

        $categoryIds = [];
        foreach ($product->categories as $category) {
            $categoryIds[] = $category->id;
        }
        $uploadedImages = [];


        $fileSystem = new Filesystem();
        foreach ($product->galleries as $gallery) {
            $uploadedImages[] = [
                "path" => $gallery->image,
                "url" => Image::create('product')->url($gallery->image),
                'mimeType'=> Storage::disk('product')->mimeType($gallery->image),
                'name'=> $fileSystem->basename($gallery->image)
            ];
        }

        return $this->render('catalog.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'categoryIds' => $categoryIds,
            'uploadedImages' => \json_encode($uploadedImages)
        ]);
    }


    public function update(ProductRequest $request)
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
        try {
            Category::rebuild();
            return redirect()->route('category')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());

        }
    }
}
