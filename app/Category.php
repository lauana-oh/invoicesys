<?php

namespace App;

use App\Http\Helpers\ivaConverter;
use App\Traits\ColumnFillable;
use App\Traits\SaveToUcFirst;
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
    
    /**
     * Return relationship between category and products
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    /**
     * Return product iva in percentage
     * @return string
     */
    public function getIvaFormattedAttribute(): string
    {
        $iva = new ivaConverter();
        $iva->setIvaInteger($this->iva);
        return sprintf(" %02.1f%%", $iva->convertIvaIntoPercentage());
    }
    
}
