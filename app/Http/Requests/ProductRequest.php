<?php

namespace App\Http\Requests;

use App\Category;
use App\Http\Helpers\ivaConverter;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                Rule::unique('products')->ignore($this->product)
                ],
            'description' => 'required | min:8',
            'unit_price' => 'required | numeric',
            'stock' => 'numeric',
            'category' => 'required | exists:categories,name',
        ];
    }
    
    public function productData()
    {
        $data = $this->validated();
    
        $category_id = Category::all()->keyBy('name')->get($this->validated()['category'])->id;
        $data['category_id'] = $category_id;
        unset($data['category']);
        
        return $data;
    }
}
