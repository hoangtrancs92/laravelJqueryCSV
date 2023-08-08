<?php

namespace App\Http\Requests\Use\A02;

use App\Helpers\ErrorMessagesHelper;
use App\Rules\MailCustomRule;
use App\Rules\SingleByteRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;

class UserDirectorUpdateRequest extends FormRequest
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
        $singleByte = new SingleByteRule;
        $passwordRule = new PasswordRule;
        return [
            'email'=> ['required', new MailCustomRule, 'max:255'],
            'name' => ['required', $singleByte, 'max:100'],
            'startedDate' => ['required', 'date_format:d/m/Y'],
            'group'=> ['required', 'numeric'],
            'position' => ['required', 'numeric'],
            'updatePassword' => ['nullable','regex:/^[A-Za-z0-9]+$/', 'between:8,20',$passwordRule],
            'reUpdatePassword' => ['required_with:updatePassword,','same:updatePassword']
        ];
    }
    public function messages()
    {
        return [
            'email.required' =>  ErrorMessagesHelper::getErrorMessage('EBT001', 'Email'),
            'email' => ErrorMessagesHelper::getErrorMessage('EBT004', 'Email'),
            'email.unique' => ErrorMessagesHelper::getErrorMessage('EBT019', 'Email'),
            'email.max' => ErrorMessagesHelper::getErrorMessage('EBT002', 'Email', '255', strlen(request()->input('email'))),
            'name.required' =>  ErrorMessagesHelper::getErrorMessage('EBT001', 'User Name'),
            'name' => ErrorMessagesHelper::getErrorMessage('EBT004', 'User Name'),
            'name.max' => ErrorMessagesHelper::getErrorMessage('EBT002', 'User Name', '100', strlen(request()->input('name'))),
            'startedDate.required' => ErrorMessagesHelper::getErrorMessage('EBT001', 'Started Date'),
            'startedDate.date_format' => ErrorMessagesHelper::getErrorMessage('EBT008', 'Started Date'),
            'group.required' => ErrorMessagesHelper::getErrorMessage('EBT001', 'Group'),
            'group.numeric' => ErrorMessagesHelper::getErrorMessage('EBT010', 'Group'),
            'position.required' =>  ErrorMessagesHelper::getErrorMessage('EBT001', 'Position'),
            'position.numeric' => ErrorMessagesHelper::getErrorMessage('EBT010', 'Positon'),
            'updatePassword.regex' => ErrorMessagesHelper::getErrorMessage('EBT004', 'Password'),
            'updatePassword.between' => ErrorMessagesHelper::getErrorMessage('EBT023'),
            'reUpdatePassword.same' => ErrorMessagesHelper::getErrorMessage('EBT030'),
            'reUpdatePassword.required_with' =>ErrorMessagesHelper::getErrorMessage('EBT001', 'Password Confirmation'),
        ];
    }
}
