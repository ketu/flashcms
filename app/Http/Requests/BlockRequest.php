<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockRequest extends FormRequest
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
            'slug' => 'required|alpha_dash|max:255|unique:cms_block',
        ];

        if ($this->getMethod() == self::METHOD_POST && $this->get('id')) {
            $rules['id'] = 'required|integer';
            $rules['slug'] .= ',id,'.$this->get('id');
        }
        return $rules;
    }
}
