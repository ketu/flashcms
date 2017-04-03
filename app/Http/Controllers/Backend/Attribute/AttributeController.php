<?php

namespace App\Http\Controllers\Backend\Attribute;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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

        return $this->render('attribute.create',
            [
                'attributeTypes'=> $attributeTypes
            ]);
    }

    public function save(AttributeRequest $request)
    {

    }

    public function edit(Request $request, $id)
    {

    }

    public function update(AttributeRequest $request)
    {

    }

    public function delete(Request $request, $id)
    {

    }
}
