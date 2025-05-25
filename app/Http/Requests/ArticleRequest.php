<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'images' => ['nullable', 'array'], 
            'images.*' => ['image', 'max:1024'],
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Title required',
            'title.string' => 'The title must be text',
            'content.required' => 'Content required',
            'content.string' => 'Content must be text',
            'images.array' => 'Images must be in matrix form',
            'images.*.image' => 'Each file must be a valid image',
            'images.*.max' => 'Each image must not exceed 1MB',
        ];
    }

}
