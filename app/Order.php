<?php

namespace App;

use App\Http\Helpers\ivaConverter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * Return relationship between invoice and orders
     * @return BelongsTo
     */
    public function  invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    
    /**
     * Return relationship between product and orders
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    /**
     * Return Order ID in 000 format
     * @return string
     */
    public function getIdFormattedAttribute(): string
    {
        return sprintf(" %'03s", $this->id);
    }
    
    /**
     * Return total price of order in money format $ 00.000,00
     * @return string
     */
    public function getTotalPriceFormattedAttribute(): string
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->totalPrice);
    }
    
    /**
     * Return total price of order in float format
     * @return float
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->unit_price * $this->quantity;
    }
    
    /**
     * Return quantity of product in string format
     * @return string
     */
    public function getQuantityFormattedAttribute(): string
    {
        return str_replace(",00", "", number_format($this->quantity, 2,",","."));
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
     * Return product iva in percentage
     * @return string
     */
    public function getProductIvaFormattedAttribute(): string
    {
        $iva = new ivaConverter();
        $iva->setIvaInteger($this->productIva);
        return sprintf(" %02.1f%%", $iva->convertIvaIntoPercentage());
    }
    
    /**
     * Return product iva paid in money format $ 00.000,00
     * @return string
     */
    public function getProductIvaPaidFormattedAttribute(): string
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->productIvaPaid);
    }
    
    /**
     * Return product iva paid in float format
     * @return float
     */
    public function getProductIvaPaidAttribute(): float
    {
        return $this->productIva * $this->totalPrice;
    }
}
