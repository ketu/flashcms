<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|unique:permissions',
            'display_name' => 'required',
            'permission.*'=> 'required|integer'
        ];

        if ($this->isMethod(self::METHOD_POST) && $this->get('id')) {
            $rules['id'] = 'required|integer';
            $rules['name'] .= ',id,' . $this->get('id');
        }

        return $rules;
    }
}
