<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    /**
     * Get the property associated with the property type.
     */
    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
