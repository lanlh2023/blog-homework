<?php

namespace App\Http\Requests;

use App\Helpers\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        $id = $this->id ?? -1;

        return [
            'name' => [
                'required'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,'.$id,
                'max:255',
            ],
            'password' => [
                'required',
                'between:8,20',
            ],
            'password_confirmation' => [
                'between:8,20',
                'same:password',
            ]
        ];
    }

    /**
     * Get length of value by atrribute name
     *
     * @param string $attributeName
     * @return integer
     */
    public function getLenghtOfValueByAttributeName(string $attributeName) {
        $attribute = $this->get($attributeName);
        return strlen($attribute);
    }

    public function messages()
    {
        return [
            'name.required' => User::getMessage('form-notification.required', [':attribute']),
            'email.required' => User::getMessage('form-notification.required', [':attribute']),
            'email.email' => User::getMessage('form-notification.email'),
            'email.unique'=> User::getMessage('form-notification.unique'),
            'email.max' => User::getMessage('form-notification.max', [
                ':attribute',
                ':max',
                $this->getLenghtOfValueByAttributeName('email'),
            ]),
            'password.required' => User::getMessage('form-notification.required', [':attribute']),
            'password.between' =>  User::getMessage('form-notification.between'),
            'password_confirmation.required' => User::getMessage('form-notification.required', [':attribute']),
            'password_confirmation.same' => User::getMessage('form-notification.same'),
            'password_confirmation.between' =>  User::getMessage('form-notification.between'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'User Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
        ];
    }
}
