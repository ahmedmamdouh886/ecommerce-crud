<?php

namespace App\Services;

use App\Enum\UserType;

class ProductPriceDiscountManager
{
    /**
     * Apply discount.
     * 
     * @param mix $currPrice
     * 
     * @return mix
     */
    public static function apply($originalPrice, UserType $userType) {
        $priceDiscountInstance = ProductPriceDiscountCalculatorFactory::make($userType);

        return $priceDiscountInstance->apply($originalPrice);
    }
}
