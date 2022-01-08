<?php

namespace App\Http\Resources\Desktop;

use App\Http\Resources\BaseAPIResource;
use Illuminate\Http\Request;

class CategoryResource extends BaseAPIResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        $fieldsFilter = $request->get('fields');
        if (!empty($fieldsFilter) || $request->get('include')) {
            return $this->resource->toArray();
        }

        if (self::BULK_UPDATE == self::getAction()) {
            return $this->bulkUpdateFields();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active ? 'YES' : 'NO',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'added_by' => $this->added_by,
            'updated_by' => $this->updated_by,
        ];
    }

    /**
     * @return array
     */
    public function bulkUpdateFields(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
