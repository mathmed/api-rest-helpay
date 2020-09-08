<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Validates data sent in the request
     * @return array
    */
    public function rules()
    {
        return [
            'name' => 'required', 
            'amount' => 'required|numeric', 
            'qty_stock' => 'required|integer',
        ];
    }

    /**
     * Creates error messages
     * @return array
    */
    public function messages() {
        return [
            'name.required' => 'O campo nome é obrigatório', 
            'amount.required' => 'O campo preço é obrigatório', 
            'amount.numeric' => 'O campo preço deve ser um valor numérico', 
            'qty_stock.required' => 'O campo estoque é obrigatório',
            'qty_stock.integer' => 'O campo estoque eve ser um valor numérico',
        ];
    }
}
