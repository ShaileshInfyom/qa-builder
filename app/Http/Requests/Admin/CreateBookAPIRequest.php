<?php

namespace App\Http\Requests\Admin;

use App\Constants\TYPEConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBookAPIRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'unique:books,name'],
            'description' => ['nullable', 'string', 'unique:books,description'],
            'is_active' => ['nullable', 'boolean'],
            'type' => [Rule::in(TYPEConstant::TYPE)],
            'price' => ['nullable', 'integer'],
            'published_at' => ['nullable'],
            'publisher' => ['nullable', 'unique:books,publisher'],
            'meta' => ['nullable'],
            'code' => ['nullable'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
