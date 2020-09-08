<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /*
     * Get a list of products from db
    */
    public function list(){
        try {
            $data = Product::paginate();
            return ['data' => $data, 'status' => 200];
        } catch (\Exception $error) {
            return ['data' => $error->getMessage(), 'status' => 500];
        }  
    }
    /*
     * Get a specific product from the db
    */
    public function show($productId){
        try {
            $data = Product::find($productId);
            return ['data' => $data, 'status' => 200];
        } catch (\Exception $error) {
            return ['data' => $error->getMessage(), 'status' => 500];
        }  
    }
}