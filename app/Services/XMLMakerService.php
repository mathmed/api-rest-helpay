<?php

namespace App\Services;
use SimpleXMLElement;

class XMLMakerService
{
    /**
     * Logic create a simple XML element
     * @param array $purchaseData
     * @return SimpleXMLElement
    */
    public static function create($purchaseData)
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><dados></dados>');

        foreach($purchaseData as $key => $data) {
            if(is_array($data)){
                $card = $xml->addChild($key);
                foreach($data as $cardKey => $cardData){
                    $card->addChild($cardKey, $cardData);
                }
            }
            else $xml->addChild($key, $data);
        }
        return $xml;
    }
}