<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'name' => 'required',
            'sku' => 'required|unique:product',
            'slug' => 'required|unique:product',
            'price'=> 'required',
            'categories'=> 'required'
        ];

        if ($this->isMethod(self::METHOD_POST) && $this->get('id')) {
            $rules['id'] = 'required|integer';
            $rules['sku'] .= ',id,' . $this->get('id');
            $rules['slug'] .= ',id,' . $this->get('id');
        }

        return $rules;
    }
}