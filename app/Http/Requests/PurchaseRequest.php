<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Validates data sent in the request
     * @return array
    */
    public function rules()
    {
        return [
            'quantity_purchased' => 'required|numeric', 
            'product_id' => 'required|integer',
            'card' => 'required|array',
            'card.owner' => 'required', 
            'card.card_number' => 'required',
            'card.date_expiration' => 'required|date_format:m/Y', 
            'card.flag' => 'required', 
            'card.cvv' => 'required|numeric'
        ];
    }

    /**
     * Creates error messages
     * @return array
    */
    public function messages()
    {
        return [
            'quantity_purchased.required' => 'O campo quantidade é obrigatório', 
            'quantity_purchased.numeric' => 'O campo quantidade deve possuir um valor numérico', 
            'product_id.required' => 'O campo produto é obrigatório', 
            'product_id.required' => 'O campo produto deve possuir um valor númerico', 
            'card.required' => 'O campo cartão é obrigatório', 
            'card.array' => 'É necessário informar todos os dados do cartão', 
        ];
    }
}
