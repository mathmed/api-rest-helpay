<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Responses\ResponseMaker;
use App\Services\ProductService;

class ProductController extends Controller
{
    function __construct()
    {
        $this->productService = new ProductService();
    }

    /**
     * Display a listing of products.
     * @return \Illuminate\Http\Response
    */
    public function list()
    {
        $responseResult = $this->productService->getProducts();
        return ResponseMaker::create($responseResult);
    }

    /**
     * Shows a specific product
     * @param integer $productId
     * @return \Illuminate\Http\Response
    */
    public function show($productId)
    {
        $responseResult = $this->productService->getProductById($productId);
        return ResponseMaker::create($responseResult);
    }

    /**
     * Store a newly created product in storage.
     * @param  \Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $responseResult = $this->productService->insertProduct($request->all());
        return ResponseMaker::create($responseResult);
    }   

    /**
     * Remove the specified product from the storage.
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function delete($productId)
    {
        $responseResult = $this->productService->deleteProduct($productId);
        return ResponseMaker::create($responseResult);
    }
}
