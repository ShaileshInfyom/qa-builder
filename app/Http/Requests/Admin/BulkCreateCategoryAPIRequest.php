<?php

namespace App\Http\Requests\Admin;

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
            'data.*.description' => ['nullable', 'string', 'unique:categories,description'],
            'data.*.parent_id' => ['nullable'],
            'data.*.is_active' => ['nullable', 'boolean'],
        ];
    }
}
