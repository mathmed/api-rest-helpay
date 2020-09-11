<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testCreate()
    {
        $response = $this->withHeaders([
        ])->json('POST', '/api/products', ['name' => 'Produto', 'amount' => 99, 'qty_stock' => 10]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => ['name' => 'Produto', 'amount' => 99, 'qty_stock' => 10]
            ]);
    }

    public function testList()
    {
        $response = $this->withHeaders([
        ])->json('GET', '/api/products');

        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->withHeaders([
        ])->json('GET', '/api/products/1');

        if($response->getStatusCode() == 400)
            $response->assertJson(['data' => 'Nenhum produto encontrado']);
        else 
            $response->assertJson(['data' => ['id' => 1]]);
    }

    public function testDelete()
    {
        $response = $this->withHeaders([
        ])->json('DELETE', '/api/products/1');

        if($response->getStatusCode() == 400)
            $response->assertJson(['data' => 'Não foi possível encontrar o produto solicitado']);
        else 
            $response->assertJson(['data' => 'Produto deletado']);
    }
}
