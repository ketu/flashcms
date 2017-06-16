<?php

namespace App\Http\Controllers\Catalog;

use App\FlashCMS\Helpers\Image;
use App\Http\Controllers\FrontendController;
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

class ProductController extends FrontendController
{

    public function index(Request $request)
    {
        $products = Product::all();
        return $this->render('product.index', [
            'products' => $products
        ]);
    }
    public function info(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        return $this->render(
            'product.info',
            [
                'product'=> $product,

            ]
        );
    }
}
