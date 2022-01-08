<?php

namespace App\Http\Requests\Admin;

use App\Constants\TYPEConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkCreateBookAPIRequest extends FormRequest
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
            'data.*.name' => ['nullable', 'string', 'unique:books,name'],
            'data.*.description' => ['nullable', 'string', 'unique:books,description'],
            'data.*.is_active' => ['nullable', 'boolean'],
            'data.*.type' => [Rule::in(TYPEConstant::TYPE)],
            'data.*.price' => ['nullable', 'integer'],
            'data.*.published_at' => ['nullable'],
            'data.*.publisher' => ['nullable', 'unique:books,publisher'],
            'data.*.meta' => ['nullable'],
            'data.*.code' => ['nullable'],
            'data.*.category_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
