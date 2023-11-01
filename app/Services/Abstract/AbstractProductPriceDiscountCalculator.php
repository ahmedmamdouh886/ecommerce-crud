<?php

namespace App\Services\Abstract;

use App\Services\Interface\ProductPriceDiscountCalculatorBasedOnUserMembership;

class AbstractProductPriceDiscountCalculator implements ProductPriceDiscountCalculatorBasedOnUserMembership
{
    /**
     * Discount percentage.
     * 
     * @var int
     */
    protected int $discountPercentage = 0;

     /**
     * Apply discount.
     * 
     * @param int|double $currPrice
     * 
     * @return int|double
     */
    public function apply($originalPrice) {
        return $originalPrice - $this->calculateDiscount($originalPrice);
    }

    /**
     * Calculate discount.
     * 
     * @param int|double $currPrice
     * 
     * @return int|double
     */
    protected function calculateDiscount($originalPrice) {
        return ($this->discountPercentage / 100) * $originalPrice;
    }
}
