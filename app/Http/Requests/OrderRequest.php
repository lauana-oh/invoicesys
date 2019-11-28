<?php

namespace App\Http\Requests;

use App\Product;
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
            'quantity' => 'required | numeric',
            'product' => 'required | exists:products,name'
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
    
    public function orderUpdateData($invoice)
    {
        $data = $this->validated();
        $product = clone Product::all()->keyBy('name')->get($this->validated()['product']);
    
        $data['product_id'] = $product->id;
        unset($data['product']);
        
        return $data;
    }
}
