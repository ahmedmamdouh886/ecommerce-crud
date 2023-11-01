<?php

namespace App\Services;

use App\Services\Abstract\AbstractProductPriceDiscountCalculator;
use App\Services\Interface\ProductPriceDiscountCalculatorBasedOnUserMembership;

class SilverMembershipProductPriceDiscountCalculator extends AbstractProductPriceDiscountCalculator implements ProductPriceDiscountCalculatorBasedOnUserMembership
{
    /**
     * Discount percentage.
     * 
     * @var int
     */
    protected int $discountPercentage = 10;
}
