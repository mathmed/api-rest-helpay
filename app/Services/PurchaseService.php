<?php

namespace App\Services;
use App\Repositories\PurchaseRepository;
use App\Repositories\ProductRepository;
use App\Services\XMLMakerService;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailPurchase;

class PurchaseService
{
    function __construct()
    {
        $this->purchaseRepository = new PurchaseRepository();
    }

    /**
     * Logic to make a new purchase
     * @param array $purchaseData
     * @return array
    */
    function newPurchase($purchaseData)
    {
        if($this->simpleValidateCreditCard($purchaseData["card"])){
            
            if($this->validadeStockForPurchase($purchaseData["product_id"], $purchaseData["quantity_purchased"])){
                
                /* Create a XML */
                $xml = XMLMakerService::create($purchaseData);
            
                /* Upload a XML */
                $googleDriveService = new GoogleDriveService();
                $googleDriveResponse = $googleDriveService->uploadXmlFile($xml);

                if($googleDriveResponse["status"] === 200){

                    Mail::to(env('MAIL_TO'))->send(new SendMailPurchase($googleDriveResponse["data"]));
                    
                    /* Finally, update databases */
                    return $this->purchaseRepository->store($purchaseData);

                }

                else return $googleDriveResponse;
            }

            else {
                return [
                    'data' => 'Não foi possível realizar a compra, não existe estoque suficiente do produto',
                    'status' => 400
                ];
            }
            
        } else {
            return [
                'data' => 'Não foi possível realizar a compra, verifique os dados do cartão de crédito',
                'status' => 400
            ];
        }
    }

    /**
     * Logic to get the last purchase of a product
     * @param integer $productId
     * @return array
    */
    function getLastPurchase($productId)
    {
        return $this->purchaseRepository->show($productId);
    }

    /**
     * Simple regex-based credit card validation
     * @param array $creditCard
     * @return boolean
    */
    private function simpleValidateCreditCard($creditCard)
    {
        $regexCreditCards = [
            'American Express' => ['valid' => '/^([34|37]{2})([0-9]{13})$/'], 
            'Dinners' => ['valid' => '/^([30|36|38]{2})([0-9]{12})$/'], 
            'Discover Card' => ['valid' => '/^([6011]{4})([0-9]{12})$/'], 
            'MasterCard' => ['valid' => '/^([51|52|53|54|55]{2})([0-9]{14})$/'], 
            'Visa' => ['valid' => '/^([4]{1})([0-9]{12,15})$/'], 
            'Visa Retired' => ['valid' => '/^([4]{1})([0-9]{12,15})$/'], 
        ];

        $cardNumber = $creditCard["card_number"];
        $cardFlag = $creditCard["flag"];
        
        if(isset($regexCreditCards[$cardFlag])){

            $cardValidate = $regexCreditCards[$cardFlag];
            return preg_match($cardValidate['valid'], $cardNumber);

        }

        return false;
    }

    /**
     * Checks whether the quantity of the product in stock is greater
     * than or equal to the quantity purchased
     * @param integer $productId
     * @param integer $qtyPurchased
     * @return boolean
    */
    private function validadeStockForPurchase($productId, $qtyPurchased)
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->show($productId)["data"];

        if($product)
            return $product->fresh()->qty_stock >= $qtyPurchased;
            
        return false;
    }
}
