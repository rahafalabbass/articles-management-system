<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [

            'email' => ['required', 'string', 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+|\d{10}$/'],
            'password' => ['required', 'string', 'max:255', 'min:8']
        ];
    }


    public function message(){
        return [
            'email.required'=> 'Email is required',
            'password.required'=> 'Password is required',
            'password.min'=> 'password must  be at lest 8 characters'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

}
