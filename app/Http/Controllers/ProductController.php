<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Responses\ResponseMaker;
use App\Services\ProductService;

class ProductController extends Controller
{
    function __construct(){
        $this->productService = new ProductService();
    }

    /**
     * Display a listing of products.
     * @return \Illuminate\Http\Response
    */
    public function list($productId = null){
        $responseResult = $this->productService->getProducts($productId);
        return ResponseMaker::create($responseResult);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
