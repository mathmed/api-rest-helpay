<?php

namespace App\Services;
use App\Repositories\ProductRepository;
use App\Services\PurchaseService;

class ProductService
{
    function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    /**
     * Logic for get a product by id
     * @param integer $productId
     * @return array
    */
    function getProductById($productId = null)
    {

        $productInfo = $this->productRepository->show($productId);
        
        if(!$productInfo["data"])
            return ["data" => "Nenhum produto encontrado", "status" => 400];

        $purchaseService = new PurchaseService();
        $lastPurchaseInfo = $purchaseService->getLastPurchase($productId);
        
        /**
         * Add 2 new attibutes to product 
         * last_sale_date -> date the product was last sold
         * last_sale_total_price -> total value ($) of the last sale of the product
        */
        
        $productInfo["data"]->last_sale_date = isset($lastPurchaseInfo["data"]->updated_at)
            ? $lastPurchaseInfo["data"]->updated_at : null;
        
        $productInfo["data"]->last_sale_total_price = isset($lastPurchaseInfo["data"]->updated_at)
            ? $lastPurchaseInfo["data"]->quantity_purchased * $productInfo["data"]->amount: null;
        
        return $productInfo;
    }

    /**
     * Logic for listing products
     * @return array
    */
    function getProducts()
    {
        return $this->productRepository->list();
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