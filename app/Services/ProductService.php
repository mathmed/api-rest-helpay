<?php

namespace App\Services;
use App\Repositories\ProductRepository;

class ProductService
{
    function __construct(){
        $this->productRepository = new ProductRepository();
    }

    /**
     * Rules for listing products
     * @return array
    */
    function getProducts($productId = null){

        /**
         * Some logic ....
        */
        
        if(!$productId)
            $response = $this->productRepository->list();
        else
            $response = $this->productRepository->show($productId);

        if($response["data"] == null)
            $response = ["data" => "Nenhum produto encontrado", "status" => 400];

        return $response;
    }
    
}