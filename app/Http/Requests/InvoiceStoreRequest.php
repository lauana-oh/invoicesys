<?php

namespace App\Http\Requests;

use App\Company;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceStoreRequest extends FormRequest
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
            'invoice_date' => 'required | date',
            'delivery_date' => 'nullable | date',
            'due_date' => 'required | date',
            'client' => 'required',
            'vendor' => 'required',
        ];
    }
    
    public function invoiceData(){
        $data = $this->validated();
        
        $client_id = Company::all()->keyBy('name')->get($this->validated()['client'])->id;
        $data['client_id'] = $client_id;
        unset($data['client']);
    
        $vendor_id = Company::all()->keyBy('name')->get($this->validated()['vendor'])->id;
        $data['vendor_id'] = $vendor_id;
        unset($data['vendor']);
        
        return $data;
    }
}
