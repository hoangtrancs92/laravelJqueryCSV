<?php

namespace App\Http\Requests\Gro;

use App\Helpers\ErrorMessagesHelper;
use App\Rules\MailCustomRule;
use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
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
            'csvFile' => ['required','file', 'mimes:csv,xlsx,txt', 'max:1280']
        ];
    }

    public function messages()
    {
        return [
            'csvFile.required' => ErrorMessagesHelper::getErrorMessage('EBT001', 'CSV'),
            'csvFile.max' => ErrorMessagesHelper::getErrorMessage('EBT033', '1MB'),
            'csvFile.mimes' => ErrorMessagesHelper::getErrorMessage('EBT034', 'CSV'),
        ];
    }
}
