<?php

namespace App\Http\Requests;

use App\Helpers\User;
use App\Rules\RegisterUserRule;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
        $rules = $this->getRulesForUser();
        return [
            'name' => [
                'required'
            ],
            'email' => $rules['email'],
            'avatar' => [
                'nullable',
                'mimes:png,jpeg,jpg',
            ],
            'password' => $rules['password'],
            'password_confirmation' => [
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
    public function getLenghtOfValueByAttributeName(string $attributeName)
    {
        $attribute = $this->get($attributeName);
        return strlen($attribute);
    }

    /**
     * Get rules if exists user
     *
     * @return array $rules
     */
    public function getRulesForUser()
    {
        $rules['email'] = 'required|email|max:255|unique:users,email';

        if (!empty($this->id)) {
            $rules['password'] = 'nullable';
            $rules['email'] .= ", $this->id";
        } else {
            $rules['password'] = 'required|between:8,20';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => User::getMessage('form-notification.required', [':attribute']),
            'email.required' => User::getMessage('form-notification.required', [':attribute']),
            'email.email' => User::getMessage('form-notification.email'),
            'email.unique' => User::getMessage('form-notification.unique'),
            'email.max' => User::getMessage('form-notification.max', [
                ':attribute',
                ':max',
                $this->getLenghtOfValueByAttributeName('email'),
            ]),
            'avatar.mimes' => Lang::get('messages.mimes', ['mimes' => 'png,jpeg,jpg']),
            'password.required' => User::getMessage('form-notification.required', [':attribute']),
            'password.between' =>  User::getMessage('form-notification.between'),
            'password_confirmation.required' => User::getMessage('form-notification.required', [':attribute']),
            'password_confirmation.same' => User::getMessage('form-notification.same'),
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
