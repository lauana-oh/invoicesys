<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;

class Company extends Model
{
    public function invoicesAsClient()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }
    
    public function invoicesAsVendor()
    {
        return$this->hasMany(Invoice::class,'vendor_id');
    }
}
