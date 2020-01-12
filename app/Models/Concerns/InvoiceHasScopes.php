<?php
namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait InvoiceHasScopes {
    public function scopeDueDateStartsBefore(Builder $query, $date)
    {
        if ($date) {
            return $query->where('due_date', '>', $date);
        }
    }
    
    public function scopeDueDateBetween(Builder $query, $start_date, $end_date)
    {
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);
        
        return $query->whereBetween('due_date', [$start_date, $end_date]);
    }
}
