<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'description',
        'is_active',
        'created_at',
        'updated_at',
        'added_by',
        'updated_by',
        'type',
        'price',
        'published_at',
        'publisher',
        'meta',
        'stock',
        'code',
        'category_id',
    ];

    /**
     * @return string[]
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return Book::class;
    }

    /**
     * @return string[]
     */
    public function getAvailableRelations(): array
    {
        return ['addedByUser', 'updatedByUser', 'category'];
    }
}
