<?php
namespace App\Models\Concerns;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait InvoiceHasScopes {
    public function scopeSearch(Builder $query, string $term = null): Builder
    {
        if(!$term) {
            return $query;
        }
        
        if(in_array($term, ['draft', 'overdue', 'send', 'paid', 'canceled', 'write-off'])) {
            return $query->status($term);
        }
        
        return $query->where('invoices.id', $term);
    }
    
    public function scopeStatus(Builder $query, string $term = null, string $boolean = 'and'): Builder
    {
        return $query->status()->name($term);
    }
    
    public function scopeDueDateStartsAfter(Builder $query, $date): Builder
    {
        return $query->where('due_date', '>=', Carbon::parse($date));
    }
    
    public function scopeDueDateEndsBefore(Builder $query, $end_date)
    {
        return $query->where('due_date', '<=', Carbon::parse($end_date));
    }
}
