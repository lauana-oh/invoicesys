<?php

namespace App\Http\Requests;

use App\Http\Helpers\ivaConverter;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                Rule::unique('categories')->ignore($this->category)
                ],
            'description' => 'required | min: 5',
            'iva' => 'numeric'
        ];
    }
    
    public function categoryData()
    {
        $data = $this->validated();
    
        $ivaPercent = new ivaConverter();
        $ivaPercent->setIvaPercent($data['iva']);
        $data['iva']= $ivaPercent->convertIvaIntoInteger();
        
        return $data;
    }
}
