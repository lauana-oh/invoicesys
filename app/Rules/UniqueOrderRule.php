<?php

namespace App\Rules;

use App\Order;
use App\Product;
use Illuminate\Contracts\Validation\Rule;

class UniqueOrderRule implements Rule
{
    private $invoice_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product_id = Product::all()->keyBy('name')->get($value)->id ;
        if(Order::where('invoice_id', $this->invoice_id)->where('product_id', $product_id)->count() == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This invoice alrealdy has this :attribute ';
    }
}
