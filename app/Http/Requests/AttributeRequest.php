<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'code' => 'required|alpha_dash|max:255|unique:attribute',
            'type' => 'required'
        ];

        $attributeTypes = Config::get('flashcms.attribute.type');
        $attributeTypeHasOption = Config::get('flashcms.attribute.hasOption');

        if ($this->get('type') && in_array($this->get('type'), $attributeTypeHasOption)) {
            $rules['option.label.*'] = 'required';
        }

        if ($this->getMethod() == self::METHOD_POST && $this->get('id')) {
            $rules['id'] = 'required|integer';
            $rules['code'] .= ',id,'.$this->get('id');
        }
        return $rules;
    }
}
