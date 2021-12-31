<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Book extends Model
{
    use HasRecordOwnerProperties;
    use LogsActivity;

    /**
     * @var string
     */
    protected $table = 'books';

    /**
     * @var string[]
     */
    protected $fillable = [
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
     * @var string[]
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
        'added_by' => 'integer',
        'updated_by' => 'integer',
        'type' => 'string',
        'price' => 'double',
        'published_at' => 'datetime',
        'publisher' => 'string',
        'meta' => 'json',
        'stock' => 'integer',
        'code' => 'string',
        'category_id' => 'integer',
    ];

    protected static $logAttributes = ['id', 'name', 'description', 'is_active', 'created_at', 'updated_at', 'added_by', 'updated_by', 'type', 'price', 'published_at', 'publisher', 'meta', 'stock', 'code', 'category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
