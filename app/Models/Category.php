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
        'parent_id',
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
        'parent_id' => 'integer',
        'is_active' => 'boolean',
        'added_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $existingModel = $model->orderBy('id', 'desc')->first();
            static::createNameString($existingModel, $model);
        });

        static::updating(function ($model) {
            static::updateNameString($model);
        });
    }

    /**
     * @param $existingModel
     * @param $creatingModel
     *
     * @return string
     */
    public static function createNameString($existingModel, $creatingModel): string
    {
        $series = 5;
        if (!empty($existingModel)) {
            preg_match('~SML(.*?)LADU~', $existingModel->name, $output);
            $series = $output[1] + 1;
        }

        return $creatingModel->name = 'SML'.$series.'LADU';
    }

    /**
     * @param $updatingModel
     *
     * @return mixed
     */
    public static function updateNameString($updatingModel)
    {
        return $updatingModel->name = $updatingModel->where('id', $updatingModel->id)->first()->name;
    }

    protected static $logAttributes = ['id', 'name', 'description', 'parent_id', 'is_active', 'created_at', 'updated_at', 'added_by', 'updated_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
