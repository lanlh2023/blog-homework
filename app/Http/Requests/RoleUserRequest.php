<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class RoleUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userId'=> [
                'required',
            ],
            'roleId' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'userId.required' => Lang::get('messages.required'),
            'roleId.required' => Lang::get('messages.required'),
        ];
    }

    public function attributes()
    {
        return [
            'userId' => 'User ID',
            'roleId' => 'Role ID',
        ];
    }
}
