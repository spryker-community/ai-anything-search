<?php

namespace Pyz\Zed\ProductVectorDbStorage\Business\Facade;

interface ProductVectorDbStorageFacadeInterface 
{
    public function writeProductDataToVectorDb(array $transfers):void;
}