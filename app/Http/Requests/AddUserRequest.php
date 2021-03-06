<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//class AddUserRequest extends FormRequest
class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login'=>'required | unique:users',
            'email'=>'required | email | unique:users',
            'password'=>'required | confirmed | min:6',
            'select_role'=>'required'
        ];
    }
}
