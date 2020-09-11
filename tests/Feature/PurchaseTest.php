<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    public function testCreate()
    {

        $body = [
            "quantity_purchased" => 1000,
            "product_id" => 1,
            "card" => [
                "owner" => "Mateus" ,
                "card_number" => "4539524042353483",  
                "date_expiration" => "10/2025",
                "flag" => "Visa",
                "cvv" => 266
            ]
            ];

        $response = $this->withHeaders([
        ])->json('POST', '/api/purchase', $body);

        $response->assertJson(['data' => 'Não foi possível realizar a compra, não existe estoque suficiente do produto']);
    }

}
