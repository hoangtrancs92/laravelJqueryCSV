<?php

namespace App\Http\Requests\Use\A02;

use App\Helpers\ErrorMessagesHelper;
use App\Rules\MailCustomRule;
use App\Rules\SingleByteRule;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;
class UserUpdateRequest extends FormRequest
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
        $passwordRule = new PasswordRule;
        return [
            'updatePassword' => ['nullable','regex:/^[A-Za-z0-9]+$/', 'between:8,20', $passwordRule],
            'reUpdatePassword' => ['required_with:updatePassword,','same:updatePassword']
        ];
    }
    public function messages()
    {
        return [
            'updatePassword.regex' => ErrorMessagesHelper::getErrorMessage('EBT004', 'Password'),
            'updatePassword.between' => ErrorMessagesHelper::getErrorMessage('EBT023'),
            'reUpdatePassword.same' => ErrorMessagesHelper::getErrorMessage('EBT030'),
            'reUpdatePassword.required_with' =>ErrorMessagesHelper::getErrorMessage('EBT001', 'Password Confirmation'),
        ];
    }
}
