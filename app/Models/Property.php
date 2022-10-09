<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $with = ['propertyType'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            if (!$model->uuid) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Get the propertyType that owns the property.
     */
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

}
