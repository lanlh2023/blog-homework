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
        $rule['image_title'] = ['required'];
        if (! $this->id || $this->hasFile('image_title') && $this->id) {
            array_push($rule['image_title'], 'mimes:png,jpeg,jpg');
        }

        return [
            'title' => [
                'required',
            ],
            'image_title' => $rule['image_title'],
            'content' => [
                'required',
            ],
            'content_title' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => Lang::get('messages.required'),
            'image_title.required' => Lang::get('messages.required'),
            'image_title.mimes' => Lang::get('messages.mimes', ['mimes' => 'png,jpeg,jpg']),
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
