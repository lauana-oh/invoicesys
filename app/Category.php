<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
