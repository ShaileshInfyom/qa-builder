<?php

namespace App\Http\Requests\Desktop;

use App\Constants\TYPEConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookAPIRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'unique:books,name,'.$this->route('book')],
            'description' => ['nullable', 'string', 'unique:books,description,'.$this->route('book')],
            'is_active' => ['nullable', 'boolean'],
            'type' => [Rule::in(TYPEConstant::TYPE)],
            'price' => ['nullable', 'integer'],
            'published_at' => ['nullable'],
            'publisher' => ['nullable', 'unique:books,publisher,'.$this->route('book')],
            'meta' => ['nullable'],
            'stock' => ['nullable', 'integer'],
            'code' => ['nullable'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
