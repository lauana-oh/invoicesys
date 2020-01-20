<?php

namespace App\Models;

use App\Http\Helpers\ivaConverter;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\ColumnFillable;
use App\Models\Concerns\SaveToUcFirst;
use Illuminate\Database\Eloquent\Model;

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
    
    /**
     * Return array to be searched
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }
}
