<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'per_page' => [
                'nullable',
                'numeric',
            ],
            'status' => [
                'nullable',
                Rule::in([0, 1]),
            ],
            'date' => [
                'nullable',
                'date',
            ],
        ];
    }
}
