<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=> [
                'required',
            ],
            'image_title' => [
                'required',
                'mimes:jpeg,png',
            ],
            'content' => [
                'required',
            ],
            'content_title' => [
                'required',
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => Lang::get('messages.required'),
            'image_title.required' => Lang::get('messages.required'),
            'image_title.mimes' => Lang::get('messages.mimes', ['mimes' => 'jpeg,png,jpg,gif']),
            'content.required' => Lang::get('messages.required'),
            'content_title.required' => Lang::get('messages.required'),
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'image_title' => 'Image title',
            'content' => 'Content',
            'content_title' => 'Content Title',
        ];
    }
}
