<?php

namespace App\Http\Requests\Use;

use App\Helpers\ErrorMessagesHelper;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'startDateFrom' => ['nullable', 'date_format:d/m/Y'],
            'startDateTo' => ['nullable', 'date_format:d/m/Y','after_or_equal:startDateFrom']
        ];
    }
    public function messages()
    {
        return [
            'startDateFrom.date_format' => ErrorMessagesHelper::getErrorMessage('EBT008', 'Started Date From'),
            'startDateTo.date_format' => ErrorMessagesHelper::getErrorMessage('EBT008', 'Started Date To'),
            'startDateTo.after_or_equal' => ErrorMessagesHelper::getErrorMessage('EBT044'),
        ];
    }
}
