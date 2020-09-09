<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Http\Responses\ResponseMaker;
use App\Services\PurchaseService;


class PurchaseController extends Controller
{

    function __construct()
    {
        $this->purchaseService = new PurchaseService();
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\PurchaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $responseResult = $this->purchaseService->newPurchase($request->all());
        return ResponseMaker::create($responseResult);
    }


}
