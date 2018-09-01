<?php

namespace App\Http\Controllers\Backend\Link;

use App\FlashCMS\Helpers\FlashCMS;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\LinkRequest;
use App\Models\Link\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LinkController extends BackendController
{
    public function index(Request $request)
    {
        $links = Link::all();
        return $this->render('links.index', [
            'links' => $links
        ]);
    }

    public function create(Request $request)
    {

        return $this->render('links.create');
    }

    public function save(LinkRequest $request)
    {
        try {
            $link = new Link();
            $link->name = $request->get('name');
            $link->status = $request->get('status', false);
            $link->link = $request->get('link');
            if ($request->file('logo')) {
                $destFolder = FlashCMS::getLogoUploadFolder();
                $path = Storage::disk('link')->putFile($destFolder, $request->file('logo'));
                $link->logo = $path;
            }

            $link->save();

            return redirect()->route('links.edit', ['id' => $link->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }


    public function edit(Request $request, $id)
    {
        $link = Link::findOrFail($id);


        return $this->render('links.edit', [
            'link' => $link
        ]);
    }

    public function update(LinkRequest $request)
    {
        try {
            $id = $request->get('id');
            $link = Link::findOrFail($id);
            $link->name = $request->get('name');
            $link->status = $request->get('status', false);
            $link->link = $request->get('link');

            if ($request->file('logo')) {

                Storage::disk('link')->delete($link->logo);
                $destFolder = FlashCMS::getLogoUploadFolder();
                $path = Storage::disk('link')->putFile($destFolder, $request->file('logo'));
                $link->logo = $path;
            }

            $link->save();

            return redirect()->route('links')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $link = Link::findOrFail($id);

            if ($link->logo) {
                Storage::disk('link')->delete($link->logo);
            }

            $link->delete();


            return redirect()->route('links')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
