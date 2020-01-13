<?php


namespace App\Models\Formats;


trait InvoiceFormatting
{
    /**
     * Return Id in #000000 format
     * @return string
     */
    public function getIdFormattedAttribute(): string
    {
        return sprintf(" #%'06s", $this->id);
    }
    
    /**
     * Return Total of invoice in money format
     * @return string
     */
    public function getTotalPaidFormattedAttribute()
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->totalPaid);
    }
    
    /**
     * Return total of invoice in number format
     * @return float
     */
    public function getTotalPaidAttribute(): float
    {
        $total=0;
        $orders = $this->orders;
        foreach ($orders as $order){
            $total += $order->totalPrice;
        }
        return $total;
    }
    
    /**
     * Return subtotal of invoice in money format
     * @return string
     */
    public function getSubtotalFormattedAttribute()
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->subtotal);
    }
    
    /**
     * Return total of invoice in number format
     * @return float
     */
    public function getSubtotalAttribute(): float
    {
        $total = $this->totalPaid;
        $ivaPaid = $this->totalIvaPaid;
        return $total-$ivaPaid;
    }
    
    /**
     * Return total IVA of invoice in money format
     * @return string
     */
    public function getTotalIvaPaidFormattedAttribute()
    {
        setlocale(LC_MONETARY, 'es_CO.UTF-8');
        return money_format(" %.2n", $this->totalIvaPaid);
    }
    
    /**
     * Return total IVA of invoice in number format
     * @return float
     */
    public function getTotalIvaPaidAttribute(): float
    {
        $totalIvaPaid=0;
        $orders = $this->orders;
        foreach ($orders as $order){
            $totalIvaPaid += $order->productIvaPaid;
        }
        return $totalIvaPaid;
    }
    
}