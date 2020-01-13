<?php

namespace App\Models;

use App\Models\Formats\InvoiceFormatting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\InvoiceHasScopes;

/**
 * @method static findOrFail($id)
 * @method static create(array $invoiceData)
 */
class Invoice extends Model
{
    use ColumnFillable;
    use SoftDeletes;
    use InvoiceHasScopes;
    use InvoiceFormatting;
    
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];
    
    /**
     * Return relationship between client and invoices
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'client_id')->withTrashed()->withDefault();
    }
    
    /**
     * Return relationship between vendor and invoices
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'vendor_id')->withTrashed()->withDefault();
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
     * Return relationship between invoice and status
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    /**
     * Return a searchable array including relationships
     * @return array
     */
    public function toSearchableArray()
    {
        $invoice = $this->toArray();
        $client = $this->client->toArray();
        $vendor = $this->vendor->toArray();
        $status = $this->status->toArray();

        return array_merge_recursive($invoice, $client, $vendor, $status);
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
    
    /**
     * Refresh status of invoice based on due date
     * @return bool
     */
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
