<?php

namespace App\Services;
use App\Repositories\ProductRepository;

class ProductService
{
    function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    /**
     * Logic for listing products
     * @return array
    */
    function getProducts($productId = null)
    {
        if(!$productId)
            $response = $this->productRepository->list();
        else
            $response = $this->productRepository->show($productId);

        if($response["data"] == null)
            $response = ["data" => "Nenhum produto encontrado", "status" => 400];

        return $response;
    }

    /**
     * Logic for insert products
     * @return array
    */
    function insertProduct($productData)
    {
        return $this->productRepository->store($productData);
    }


    /**
     * Logic for delete products
     * @return array
    */
    function deleteProduct($productId)
    {
        return $this->productRepository->delete($productId);
    }
    
}