<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    /**
     * Return relationship between status and invoices
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany( Invoice::class, 'status_id');
    }
}
