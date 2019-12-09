<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'name' => 'required | min:3',
            'nit' => [
                'required',
                'numeric',
                'min:10000',
                'max:9999999999999',
                Rule::unique('companies')->ignore($this->company),
            ],
            'email' => 'email | nullable',
            'phone' => 'min:7 | max:11 | nullable',
            'address' => 'max:255 | nullable',
        ];
    }
}
