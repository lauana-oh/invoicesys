<?php

namespace App\Models;

use App\Models\Concerns\ColumnFillable;
use App\Models\Concerns\SaveToUcFirst;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static create(Http\Requests\CompanyRequest $request)
 */
class Company extends Model
{
    use SoftDeletes;
    use ColumnFillable;
    use SaveToUcFirst;
    
    /**
     * Return relationship between client and invoice
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicesAsClient()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }
    
    /**
     * Return relationship between vendor and invoice
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicesAsVendor()
    {
        return $this->hasMany(Invoice::class,'vendor_id');
    }
    
    /**
     * Return array to be searched
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }
}
