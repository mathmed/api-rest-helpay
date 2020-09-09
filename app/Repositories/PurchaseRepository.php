<?php

namespace App\Repositories;

use App\Models\Purchase;
use App\Models\Product;

class PurchaseRepository
{
    /**
     * Save a purchase to the db
     * @param array $purchase
     * @return array
    */
    public function store($purchaseData)
    {
        try {
            \DB::beginTransaction();
            $product = Product::find($purchaseData["product_id"]);
            if ($product->update(['qty_stock' => ($product->qty_stock - $purchaseData['quantity_purchased'])])) {
                $purchase = Purchase::create($purchaseData);
                \DB::commit();
                
            return ['data' => $purchase, 'status' => 200];
        }
            \DB::rollback();
            return ['data' => 'Erro ao realizar compra, verifique os dados enviados', 'status' => 400];

        } catch (\Exception $error) {
            \DB::rollback();
            return ['data' => $error->getMessage(), 'status' => 500];
        }
    }
}