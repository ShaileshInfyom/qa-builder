<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class BulkCreateCategoryAPIRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'data.*.name' => ['nullable', 'string'],
            'data.*.description' => ['nullable', 'string'],
            'data.*.is_active' => ['boolean'],
        ];
    }
}
