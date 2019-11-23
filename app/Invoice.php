<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function client()
    {
        return $this->belongsTo(Company::class, 'client_id');
    }
    
    public function vendor()
    {
        return $this->belongsTo(Company::class, 'vendor_id');
    }

    public function orders()
    {
        return$this->hasMany(Order::class, 'invoice_id');
    }
}
