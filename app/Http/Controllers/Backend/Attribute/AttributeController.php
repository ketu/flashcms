<?php

namespace App\Http\Controllers\Backend\Attribute;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AttributeController extends BackendController
{
    public function index(Request $request)
    {
        $attributes = Attribute::all();
        return $this->render('attribute.index', [
            'attributes' => $attributes
        ]);
    }

    public function create(Request $request)
    {

        $attributeTypes = Config::get('flashcms.attribute.type');
        $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');
        return $this->render('attribute.create',
            [
                'attributeTypes'=> $attributeTypes,
                'attributeTypeHasOption'=> \json_encode($attributeTypeHasOption)
            ]);
    }

    public function save(AttributeRequest $request)
    {
        try {
            $currentLocale = app()->getLocale();
            $attribute = new Attribute();
            $attribute->code = $request->get('code');
            $attribute->status = $request->get('status', false);
            $attribute->type = $request->get('type');
            $attribute->is_required = $request->get('is_required', false);

            $attribute->translateOrNew($currentLocale)->name = $request->get('name');

            DB::beginTransaction();
            $attribute->save();

            $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');
            if (in_array($attribute->type,  $attributeTypeHasOption)) {
                $options = [];
                foreach($request->get('option_label') as $label) {
                    $option = new AttributeOption();
                    $option->translateOrNew($currentLocale)->label = $label;

                    $options[] = $option;
                }
                $attribute->options()->saveMany($options);
            }
            DB::commit();

            return redirect()->route('attribute.edit', ['id' => $attribute->id])->with('success', 'notice.success');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }

    }


    public function edit(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attributeTypes = Config::get('flashcms.attribute.type');
        $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');
        return $this->render('attribute.edit', [
            'attribute' => $attribute,
            'attributeTypes'=> $attributeTypes,
            'attributeTypeHasOption'=> \json_encode($attributeTypeHasOption)
        ]);
    }

    public function update(AttributeRequest $request)
    {
        try {
            $id = $request->get('id');
            $attribute = Attribute::findOrFail($id);
            $currentLocale = app()->getLocale();
            $attribute->code = $request->get('code');
            $attribute->status = $request->get('status', false);
            $attribute->type = $request->get('type');

            $attribute->is_required = $request->get('is_required', false);

            $attribute->translateOrNew($currentLocale)->name = $request->get('name');
            DB::beginTransaction();
            $attribute->save();

            $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');
            if (in_array($attribute->type,  $attributeTypeHasOption)) {


                foreach($request->get('option_label_exists') as $id=> $label) {
                    $option = AttributeOption::where('id', $id)->first();
                    if (!$option) {
                        continue;
                    }
                    $option->translate()->label = $label;
                    $option->save();
                }

               # $attribute->options()->delete();
                $options = [];


                foreach($request->get('option_label', []) as $label) {

                    $option = new AttributeOption();
                    $option->translateOrNew($currentLocale)->label = $label;

                    $options[] = $option;
                }
                $attribute->options()->saveMany($options);
            }
            DB::commit();


            return redirect()->route('attribute')->with('success', 'notice.success');
        }catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }
    }

    public function delete(Request $request, $id)
    {

    }
}
