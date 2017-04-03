<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $rules =  [
            'name' => 'required|max:255|min:5|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'groups.*'=> 'required'
        ];

        if ($this->isMethod(self::METHOD_POST) && $this->get('id')) {
            $rules['id'] = 'required|integer';
            $rules['name'] .= ',name,'.$this->get('name');
            $rules['email'] .= ',email,'.$this->get('email');
            unset($rules['password']);
        }
        return $rules;
    }
}
