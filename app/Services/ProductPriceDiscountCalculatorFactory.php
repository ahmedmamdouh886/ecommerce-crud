<?php

namespace App\Services;

use App\Enum\UserType;
use App\Exceptions\InvalidArgumentException;
use App\Services\Interface\ProductPriceDiscountCalculatorBasedOnUserMembership;

class ProductPriceDiscountCalculatorFactory
{
    /**
     * Create product price dicsount calculator instance based on a given type.
     * 
     * @param UserType $membershipType
     * 
     * @return \App\Services\Interface\ProductPriceDiscountCalculatorBasedOnUserMembership
     * 
     * @throws \App\Exceptions\InvalidArgumentException
     */
    public static function make(UserType $membershipType): ProductPriceDiscountCalculatorBasedOnUserMembership {
        $productPriceDiscountTypes = config('product-price-discount.based_on_user_membership');

        if (! array_key_exists($membershipType->value, $productPriceDiscountTypes)) {
            throw new InvalidArgumentException("Invalid membership type: {$membershipType->value}");
        }

        return app()->make($productPriceDiscountTypes[$membershipType->value]);
    }
}
