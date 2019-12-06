<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\ColumnFillable;

class Invoice extends Model
{
    use ColumnFillable;

    /**
     * Return relationship between client and invoices
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'client_id')->withDefault();
    }
    
    /**
     * Return relationship between vendor and invoices
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'vendor_id')->withDefault();
    }
    
    /**
     * Return relationship between invoice and orders
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'invoice_id');
    }
    
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];
    
    /**
     * Return relationship between invoice and status
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
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
    
    /**
     * Return invoice data store or update after validation
     * @param $request
     * @param $invoice
     * @return mixed
     */
    public function storeInvoice($request, $invoice)
    {
        $companies = Company::all();
        $companies = $companies->keyBy('name');
    
        $clientName = $request->client;
        $client = $companies->get($clientName);
    
        $vendorName = $request->vendor;
        $vendor = $companies->get($vendorName);
    
        $invoice->client_id = $client->id;
        $invoice->vendor_id = $vendor->id;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->delivery_date = $request->delivery_date;
        $invoice->due_date =$request->due_date;
        
        return $invoice;
    }
    
    public function refreshStatus()
    {
        $sent = Status::all()->keyBy('name')->get('sent')->id;
        $overdue = Status::all()->keyBy('name')->get('overdue')->id;
        $writeOff = Status::all()->keyBy('name')->get('write-off')->id;
        
        $daysToWriteOff = 360;
        $dueDate = strtotime($this->due_date);
        $today = strtotime(date('Y-m-d'));
        $writeOffDate = strtotime($daysToWriteOff . ' day', $dueDate);;

        if ($dueDate < $today && in_array($this->id,[$sent, $overdue, $writeOff])) {
            if ($writeOffDate < $today) {
                $this->status_id = $writeOff;
            } else {
                $this->status_id = $overdue;
            }
        }
        
        return $this->save();
    }
}
