<?php

namespace App;

use App\Traits\ColumnFillable;
use App\Traits\SaveToUcFirst;
use App\Traits\SaveToUpper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static create(array $categoryData)
 */
class Category extends Model
{
    use SoftDeletes;
    use ColumnFillable;
    use SaveToUcFirst;
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
