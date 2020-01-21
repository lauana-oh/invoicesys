<?php

namespace App\Models;

use App\Models\Concerns\ColumnFillable;
use App\Models\Concerns\SaveToUcFirst;
use App\Support\ProductCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static create(array $productData)
 */
class Product extends Model
{
    use ColumnFillable;
    use SaveToUcFirst;
    use SoftDeletes;
    
    /**
     * Return Relationship between category and product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    
    /**
     * Return relationship between product and orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
    
    /**
     * Return array to be searched
     * @return array
     */
    public function toSearchableArray()
    {
        $product = $this->toArray();
        $category = $this->category->toArray();
        
        return array_merge_recursive($product, $category);
    }
    /**
     * Return Product ID in 000 format
     * @return string
     */
    public function getIdFormattedAttribute(): string
    {
        return sprintf(" %'03s", $this->id);
    }
    
    /**
     * Return unit price of product in money format $ 00.000,00
     * @return string
     */
    public function getUnitPriceFormattedAttribute(): string
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->unit_price);
    }
    
    /**
     * Return quantity of product in string format
     * @return string
     */
    public function getStockFormattedAttribute(): string
    {
        return str_replace(",00", "", number_format($this->stock, 2,",","."));
    }
    
    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     * @return ProductCollection
     */
    public function newCollection(array $models = [])
    {
        return new ProductCollection($models);
    }
}
