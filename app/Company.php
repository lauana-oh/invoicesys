<?php

namespace App;

use App\Traits\ColumnFillable;
use App\Traits\SaveToUcFirst;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Validation\Rules\In;

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
        return$this->hasMany(Invoice::class,'vendor_id');
    }
}
