<?php

class HeurekaValidator
{
    private $requiredFields = [
        'PRODUCTNAME', 'ITEM_ID', 'CATEGORYTEXT', 'DELIVERY', 'DELIVERY_DATE',
        'IMGURL_ALTERNATIVE', 'DESCRIPTION', 'URL', 'IMGURL', 'PRICE_VAT',
        'EAN',
    ];

    public function validateItem($item)
    {
        // check required items
        $checkRequired = $this->checkRequiredItems($item);
        if (!empty($checkRequired)) {
            return $checkRequired;
        }

        /*
        foreach($item as $key => $filed)
        {

        }
        */

        return [];
    }

    private function checkRequiredItems($item)
    {
        $errors = [];

        foreach($this->requiredFields as $field) {
            if (!isset($item->$field)) {
                $errors[] = 'Item ' . $item->CODE . ': Missing required field ' . $field . '.';
            }
        }

        return $errors;
    }
}