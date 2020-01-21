<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\UniqueOrderRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required | numeric | min:0.01',
            'product' => array('required ', 'exists:products,name', new UniqueOrderRule($this->input('invoice_id'), $this->input('order_id'))),
            ];
    }

    public function orderStoreData($invoice)
    {
        $data = $this->validated();
        $product = clone Product::all()->keyBy('name')->get($this->validated()['product']);
    
        $data['product_id'] = $product->id;
        unset($data['product']);
        
        $data['invoice_id'] = $invoice->id;
        $data['unit_price'] = $product->unit_price;
        $data['product_iva'] = $product->category->iva;
        
        return $data;
    }
    
    public function orderUpdateData($invoice, $order)
    {
        $data = $this->validated();
        $product = clone Product::all()->keyBy('name')->get($this->validated()['product']);
    
        $data['invoice_id'] = $invoice->id;
        
        if ($order['product_id'] !== $product->id) {
            $data['product_id'] = $product->id;
            $data['unit_price'] = $product->unit_price;
            $data['product_iva'] = $product->category->iva;
        } else {
            $data['product_id'] = $order->product_id;
            $data['unit_price'] = $order->unit_price;
            $data['product_iva'] = $order->product_iva;
        }
        
        return $data;
    }
}
