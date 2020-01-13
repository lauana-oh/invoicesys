<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Status extends Model
{
    use Searchable;
    /**
     * Return relationship between status and invoices
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany( Invoice::class, 'status_id');
    }
    
    public function scopeName(Builder $query, string $term = null)
    {
        if ($term) {
            return $query->where('name', $term);
        }
        
        return $query;
    }
}
