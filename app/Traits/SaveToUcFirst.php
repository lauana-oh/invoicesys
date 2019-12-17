<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait SaveToUcFirst
{
    /**
     * Default params that will be saved on lowercase
     * @var array No Uppercase keys
     */
    protected $no_uppercase = [
        'password',
        'email',
        'remember_token',
    ];
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($value)) {
                if (!in_array($key, $this->no_uppercase)) {
                    $this->attributes[$key] = trim(ucfirst($value));
                }
        }
    }
}