<?php

namespace App\Services\Interface;

interface ProductPriceDiscountCalculatorBasedOnUserMembership
{
    /**
     * Apply discount.
     * 
     * @param int|double $originalPrice
     * 
     * @return int|double
     */
    public function apply($originalPrice);
}
