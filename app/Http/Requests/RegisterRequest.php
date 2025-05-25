<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'email'=> ['required'],
            'password'=> ['required','min:8','confirmed'],
            'role'=> ['required', Rule::in(['admin','expert','user'])],
            'image'=>[]
        ];
    }


    public function message(){
        return[
            'name.required'=> 'Name is required',
            'name.string'=> 'Name must  be string',
            'name.max'=> 'The name is very long',
            'email.required'=> 'Email is required',
            'password.required'=> 'password is required ',
            'password.min'=> 'password must  be at lest 8 characters',
            'password.confirmed'=> 'password is not matched',
            'role.required'=> 'Role is required',
        ];     
    }

}
