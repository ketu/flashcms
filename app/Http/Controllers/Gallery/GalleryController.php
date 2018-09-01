<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-13
 */

namespace App\Http\Controllers\Gallery;


use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;

class GalleryController extends FrontendController
{
    public function info(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        return $this->render('gallery/gallery', ["gallery"=> $gallery]);
    }
}