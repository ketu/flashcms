<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\FlashCMS\Image;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeOption;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\Template;
use App\Models\Product\Attribute as ProductAttribute;
use App\Models\Product\AttributeOption as ProductAttributeOption;
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
            $templateId = $request->get('template');
            $template = Template::findOrFail($templateId);

            $product = new Product();
            $product->translateOrNew($currentLocale)->name = $request->get('name');
            $product->translateOrNew($currentLocale)->description = $request->get('content');
            $product->sku = $request->get('sku');
            $product->slug = $request->get('slug');
            $product->price = $request->get('price');
            $product->weight = $request->get('weight');

            $product->template_id = $template->id;

            $categories = $request->get('categories', []);
            $product->status = $request->get('status', false);

            $attributes = $request->get('attributes');

            $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');

            DB::beginTransaction();

            $product->save();

            $product->categories()->detach();
            $product->categories()->attach($categories);

            foreach($attributes as $id=> $values) {
                $attribute = Attribute::findOrFail($id);
                $productAttribute = new ProductAttribute();
                $productAttribute->attribute_id = $attribute->id;
                $productAttributeOptions = [];
                if (in_array($attribute->type, $attributeTypeHasOption)) {
                    //$values = (array) $values;
                    $productAttribute->is_option_value = true;
                    if (is_scalar($values)) {
                        $option = AttributeOption::findOrFail($values);
                        $productAttribute->value = $option->id;
                    } else {
                        foreach ($values as $value) {
                            $option = AttributeOption::findOrFail($value);
                            $productAttributeOption = new ProductAttributeOption();
                            $productAttributeOption->attribute_option_id = $option->id;
                            //$productAttributeOption->product()->save($product);
                            //$productAttribute->options()->save($productAttributeOption);
                            $productAttributeOptions[] = $productAttributeOption;

                        }
                    }
                } else {
                    $productAttribute->is_option_value = false;
                    $productAttribute->value = $values;
                }
                $productAttribute->product_id = $product->id;
                $productAttribute->save();
                if ($productAttributeOptions) {
                    $productAttribute->options()->saveMany($productAttributeOptions);
                }
                //$productAttributes[] = $productAttribute;
            }


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
        $templates = Template::all();

        //$attributeTypes = Config::get('flashcms.attribute.type');
        $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');

        $attributeTypes = [];
        foreach(Config::get('flashcms.attribute.type') as $type=> $name) {
            $attributeTypes[$type] = $type;
        }


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
            'uploadedImages' => \json_encode($uploadedImages),
            'templates'=> $templates,
            'attributeTypes'=> \json_encode($attributeTypes),
            'attributeTypeHasOption'=> \json_encode($attributeTypeHasOption)
        ]);
    }


    public function update(ProductRequest $request)
    {
        try {
            $templateId = $request->get('template');
            $template = Template::findOrFail($templateId);

            $id = $request->get('id');

            $product = Product::findOrFail($id);

            $currentLocale = app()->getLocale();

            $product->translateOrNew($currentLocale)->name = $request->get('name');
            $product->translateOrNew($currentLocale)->description = $request->get('content');
            $product->sku = $request->get('sku');
            $product->slug = $request->get('slug');
            $product->price = $request->get('price');
            $product->weight = $request->get('weight');

            $product->template_id = $template->id;

            $categories = $request->get('categories', []);
            $product->status = $request->get('status', false);

            $attributes = $request->get('attributes');

            $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');

            return redirect()->route('product')->with('success', 'notice.success');

        } catch (\Exception $e) {
            DB::rollback();
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
