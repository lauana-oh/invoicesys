<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    /**
     * Return relationship between client and invoices
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'client_id');
    }
    
    /**
     * Return relationship between vendor and invoices
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'vendor_id');
    }
    
    /**
     * Return relationship between invoice and orders
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'invoice_id');
    }
    
    /**
     * Return Id in #000000 format
     * @return string
     */
    public function getIdFormattedAttribute(): string
    {
        return sprintf(" #%'06s", $this->id);
    }
    
    public function getTotalPaidFormattedAttribute()
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->totalPaid);
    }
    
    public function getTotalPaidAttribute()
    {
        $total=0;
        $orders = $this->orders;
        foreach ($orders as $order){
            $total += $order->totalPrice;
        }
        return $total;
    }
    
    public function getTotalIvaPaidFormattedAttribute()
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->totalIvaPaid);
    }
    
    public function getTotalIvaPaidAttribute()
    {
        $totalIvaPaid=0;
        $orders = $this->orders;
        foreach ($orders as $order){
            $totalIvaPaid += $order->productIvaPaid;
        }
        return $totalIvaPaid;
    }
}
