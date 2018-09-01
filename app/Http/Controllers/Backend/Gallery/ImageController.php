<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Http\Controllers\Backend\Gallery;

use App\FlashCMS\Helpers\FlashCMS;
use App\Http\Controllers\Backend\BackendController;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use App\Http\Requests\GalleryImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


class ImageController extends BackendController
{

    public function index(Request $request, $galleryId)
    {
        $gallery = Gallery::findOrFail($galleryId);

        $images = Image::where('gallery_id', $galleryId)->get();
        return $this->render('gallery.image.index', [
            'images' => $images,
            'gallery' => $gallery
        ]);
    }

    public function create(Request $request, $galleryId)
    {
        $gallery = Gallery::findOrFail($galleryId);
        $images = Image::where('gallery_id', $galleryId)->get();

        return $this->render('gallery.image.create', [
            'gallery' => $gallery,
            'images' => $images,
        ]);
    }

    public function save(GalleryImageRequest $request)
    {
        try {
            $gallery = Gallery::findOrFail($request->get('galleryId'));

            $image = new Image();
            $image->name = $request->get('name');
 
            if ($request->file('link')) {
                $destFolder = FlashCMS::getLogoUploadFolder();
                $path = Storage::disk('gallery')->putFile($destFolder, $request->file('link'));
                $image->link = $path;
            }


 
            $image->gallery_id = $gallery->id;
    

            $image->save();
            return redirect()->route('gallery.image.edit', ['id' => $image->id])->with('success', 'notice.success');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }


    public function edit(Request $request, $id)
    {
        $image = Image::findOrFail($id);


        return $this->render('gallery.image.edit', [
            'image' => $image
        ]);
    }


    public function update(GalleryImageRequest $request)
    {
        try{

            $image = Image::findOrFail($request->get('id'));
            $image->name = $request->get('name');
   
            if ($request->file('link')) {
                $destFolder = FlashCMS::getLogoUploadFolder();
                $path = Storage::disk('gallery')->putFile($destFolder, $request->file('link'));
                $image->link = $path;
            }

            $image->save();
            return redirect()->route('gallery.image', ["galleryId"=> $image->gallery_id])->with('success', trans('notice.success'));

        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        $image = Image::findOrFail($id);
        $fileName = $request->get('link');

        Storage::disk('gallery')->delete($fileName);
        
        $galleryId = $image->gallery_id;

        $image->delete();
        return redirect()->route('gallery.image', ["galleryId"=> $galleryId])->with('success', trans('notice.success'));

    }
}