<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasRecordOwnerProperties;
    use LogsActivity;

    /**
     * @var string
     */
    protected $table = 'categories';

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
    ];

    protected static $logAttributes = ['id', 'name', 'description', 'is_active', 'created_at', 'updated_at', 'added_by', 'updated_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
