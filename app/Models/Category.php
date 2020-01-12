<?php

namespace App;

use App\Http\Helpers\ivaConverter;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\ColumnFillable;
use App\Models\Traits\SaveToUcFirst;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @method static findOrFail($id)
 * @method static create(array $categoryData)
 */
class Category extends Model
{
    use SoftDeletes;
    use ColumnFillable;
    use SaveToUcFirst;
    use Searchable;
    
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