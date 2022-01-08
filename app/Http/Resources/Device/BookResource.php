<?php

namespace App\Http\Resources\Device;

use App\Http\Resources\BaseAPIResource;
use Illuminate\Http\Request;

class BookResource extends BaseAPIResource
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

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active ? 'YES' : 'NO',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'added_by' => $this->added_by,
            'updated_by' => $this->updated_by,
            'type' => $this->type,
            'price' => $this->price,
            'published_at' => $this->published_at,
            'publisher' => $this->publisher,
            'meta' => $this->meta,
            'code' => $this->code,
            'category_id' => $this->category_id,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
