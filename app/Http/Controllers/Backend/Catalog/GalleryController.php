<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Backend\BackendController;
use App\Models\Product\Gallery;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


class GalleryController extends BackendController
{

    public function upload(Request $request, $id)
    {
        $response = [];
        try {

            $product = Product::findOrFail($id);

            $destFolder = Config::get('flashcms.uploader.folder.product');

            $path = Storage::disk('product')->putFile($destFolder, $request->file('file'));

            $gallery = new Gallery();
            $gallery->image = $path;

            $product->galleries()->save($gallery);


            return [
                'success'=> true,
                'path'=>$path,
                'url'=> url($path)
            ];

        }catch (\Exception $e){
            return [
                'error'=> true,
                'message'=> $e->getMessage()
            ];
        }
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $fileName = $request->get('path');

        Storage::disk('product')->delete($fileName);


        $galleries = Gallery::where('product_id', $id)->where('image', $fileName)->get();

        foreach($galleries as $gallery) {
            $gallery->delete();
        }


    }
}