<?php

namespace App\Rules;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class UniqueOrderRule implements Rule
{
    private $invoice_id;
    private $order_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($invoice_id, $order_id)
    {
        $this->invoice_id = $invoice_id;
        $this->order_id = $order_id;
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
        $order = Order::find($this->order_id);
        $product_id = Product::all()->keyBy('name')->get($value)->id ;
        if($order && $order->product_id == $product_id){
            return true;
        } else {
            if(Order::where('invoice_id', $this->invoice_id)->where('product_id', $product_id)->count() == 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This invoice already has this :attribute ';
    }
}
