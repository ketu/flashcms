<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\FlashCMS\Helpers\FlashCMS;
use App\FlashCMS\Helpers\Image as ImageHelper;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;



class GalleryController extends BackendController
{
    public function index(Request $request)
    {
        $galleries = Gallery::all();
        return $this->render('gallery.index', [
            'galleries' => $galleries
        ]);
    }

    public function create(Request $request)
    {

        return $this->render('gallery.create');
    }

    public function save(GalleryRequest $request)
    {
        try {
            $gallery = new Gallery();
            $gallery->name = $request->get('name');
            $gallery->status = $request->get('status', false);
 
            $gallery->save();

            return redirect()->route('gallery.edit', ['id' => $gallery->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }


    public function edit(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);


        $uploadedImages = [];

        $fileSystem = new Filesystem();
        foreach ($gallery->images as $image) {
            $uploadedImages[] = [
                "path" => $image->link,
                "url" => ImageHelper::create('gallery')->url($image->link),
                'mimeType'=> Storage::disk('gallery')->mimeType($image->link),
                'name'=> $fileSystem->basename($image->link)
            ];
        }


        return $this->render('gallery.edit', [
            'gallery' => $gallery,
            'uploadedImages'=> \json_encode($uploadedImages),
        ]);
    }

    public function update(GalleryRequest $request)
    {
        try {
            $id = $request->get('id');
            $gallery = Gallery::findOrFail($id);
            $gallery->name = $request->get('name');
            $gallery->status = $request->get('status', false);
         
 

            $gallery->save();

            return redirect()->route('gallery')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            if ($gallery->images) {
                //Storage::disk('link')->delete($link->logo);
            }

            $gallery->delete();


            return redirect()->route('gallery')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
