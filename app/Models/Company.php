<?php

namespace App\Models;

use App\Models\Traits\ColumnFillable;
use App\Models\Traits\SaveToUcFirst;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * @method static findOrFail($id)
 * @method static create(Http\Requests\CompanyRequest $request)
 */
class Company extends Model
{
    use SoftDeletes;
    use ColumnFillable;
    use SaveToUcFirst;
    use Searchable;
    
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
