<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\BlockRequest;
use App\Models\Cms\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends BackendController
{

    public function index(Request $request)
    {
        $blocks = Block::translatedIn()->get();
        return $this->render('cms.block.index', [
            'blocks' => $blocks
        ]);
    }

    public function create(Request $request)
    {
        return $this->render('cms.block.create');
    }

    public function save(BlockRequest $request, $id = null)
    {
        try {
            $currentLocale = app()->getLocale();

            $block = new Block();
            $block->slug = $request->get('slug');
            $block->status = $request->get('status', false);
            $block->translateOrNew($currentLocale)->name = $request->get('name');
            $block->translateOrNew($currentLocale)->content = $request->get('content');
            $block->first_create_user = Auth::id();
            $block->save();

            return redirect()->route('cms.block.edit', ['id' => $block->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }


    public function edit(Request $request, $id)
    {
        $block = Block::findOrFail($id);

        return $this->render('cms.block.edit', [
            'block' => $block
        ]);
    }


    public function update(BlockRequest $request)
    {
        try {
            $id = $request->get('id');
            $block = Block::findOrFail($id);
            $currentLocale = app()->getLocale();
            $block->slug = $request->get('slug');
            $block->status = $request->get('status', false);
            $block->translateOrNew($currentLocale)->name = $request->get('name');
            $block->translateOrNew($currentLocale)->content = $request->get('content');
            $block->last_update_user = Auth::id();
            $block->save();

            return redirect()->route('cms.block')->with('success', 'notice.success');
        }catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }

    public function delete(Request $request, $id)
    {
        try {
            $block = Block::findOrFail($id);
            $block->delete();
            return redirect()->route('cms.block')->with('success', 'notice.success');
        }catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

    }
}
