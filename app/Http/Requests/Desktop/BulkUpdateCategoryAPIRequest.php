<?php

namespace App\Http\Requests\Desktop;

use Illuminate\Foundation\Http\FormRequest;

class BulkUpdateCategoryAPIRequest extends FormRequest
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
            'data.*.description' => ['nullable', 'string', 'unique:categories,description,'.$this->route('category')],
            'data.*.parent_id' => ['nullable'],
            'data.*.is_active' => ['nullable', 'boolean'],
        ];
    }
}
