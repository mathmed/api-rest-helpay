<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Get a list of products from db
     * @return array
    */
    public function list(){
        try {
            $data = Product::paginate();
            return ['data' => $data, 'status' => 200];
        } catch (\Exception $error) {
            return ['data' => $error->getMessage(), 'status' => 500];
        }  
    }

    /**
     * Get a specific product from the db
     * @param integer $productId
     * @return array
    */
    public function show($productId){
        try {
            $data = Product::find($productId);
            return ['data' => $data, 'status' => 200];
        } catch (\Exception $error) {
            return ['data' => $error->getMessage(), 'status' => 500];
        }  
    }

    /**
     * Get a specific product from the db
     * @param array $product
     * @return array
    */
    public function store($product) {
        try {
            $product = Product::create($product);
            return ['data' => $product, 'status' => 200];
        } catch (\Exception $error) {
            return ['data' => $error->getMessage(), 'status' => 500];
        }
    }

    /**
     * Delete a specific product from the db
     * @param integer $productId
     * @return array
    */
    public function delete($productId) {
        try {
            $product = Product::find($productId);
            if ($product) {
                if ($product->delete()) {
                    return ['data' => 'Produto deletado', 'status' => 200];
                }
                return ['data' => 'Ocorreu um erro ao deletar o produto', 'status' => 500];
            }
            return ['data' => 'Não foi possível encontrar o produto solicitado', 'status' => 400];
        } catch (\Exception $error) {
            return ['data' => $error->getMessage(), 'status' => 500];
        }
    }
}