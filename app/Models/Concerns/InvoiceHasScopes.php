<?php
namespace App\Models\Concerns;

use App\Models\Invoice;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait InvoiceHasScopes {
    public function scopeSearch(Builder $query, string $term = null): Builder
    {
        if(!$term) {
            return $query;
        }
        
        if(in_array($term, ['draft', 'overdue', 'sent', 'paid', 'cancelled', 'write-off'])) {
            return $query->statusName($term);
        }
        
        return $query->where('invoices.id', $term);
    }
    
    public function scopeStatusName(Builder $query, string $term = null, string $boolean = 'or'): Builder
    {
        return $query->where('status_id', Status::where('name', $term)->first()->id );
    }
    
    public function scopeDueDateStartsAfter(Builder $query, $date): Builder
    {
        return $query->where('due_date', '>=', Carbon::parse($date));
    }
    
    public function scopeDueDateEndsBefore(Builder $query, $date)
    {
        return $query->where('due_date', '<=', Carbon::parse($date));
    }
    
    public function scopeDeliveryDateStartsAfter(Builder $query, $date): Builder
    {
        return $query->where('delivery_date', '>=', Carbon::parse($date));
    }
    
    public function scopeDeliveryDateEndsBefore(Builder $query, $date): Builder
    {
        return $query->where('delivery_date', '<=', Carbon::parse($date));
    }
    
    public function scopeInvoiceDateStartsAfter(Builder $query, $date): Builder
    {
        return $query->where('invoice_date', '>=', Carbon::parse($date));
    }
    
    public function scopeInvoiceDateEndsBefore(Builder $query, $date): Builder
    {
        return $query->where('invoice_date', '<=', Carbon::parse($date));
    }
    
    public function scopeInvoiceMinTotal(Builder $query, $total): Builder
    {
        $invoices = Invoice::all();
        $invoices_id = [];
        foreach ($invoices as $invoice) {
            if ($invoice->totalPaid >= $total){
                array_push($invoices_id, $invoice->id);
            };
        }
        return $query->whereIn('id', $invoices_id);
    }
    
    public function scopeInvoiceMaxTotal(Builder $query, $total): Builder
    {
        $invoices = Invoice::all();
        $invoices_id = [];
        foreach ($invoices as $invoice) {
            if ($invoice->totalPaid <= $total){
                array_push($invoices_id, $invoice->id);
            };
        }
        return $query->whereIn('id', $invoices_id);
    }
    
    public function scopeStatusFilter(Builder $query, string $draft = null, $sent = null, $paid = null, $overdue = null, $writeOff = null, $cancelled = null)
    {
        dd($query->statusDraft());
        return $query->statusSelected($draft);
    }
    
    public function scopeStatusDraft(Builder $query, $draft = null)
    {
        return $query->statusName($draft);
    }
    
    public function scopeStatusSelected(Builder $query, string $term = null, $boolean = 'or' )
    {
        return $query->statusName($term);
    }
}
