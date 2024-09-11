<?php

namespace Pyz\Zed\ProductVectorDbStorage\Business;

interface ProductVectorDbStorageFacadeInterface
{
    public function writeProductDataToVectorDb(array $transfers):void;
}
