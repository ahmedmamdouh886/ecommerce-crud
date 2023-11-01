<?php

use App\Services\GoldMembershipProductPriceDiscountCalculator;
use App\Services\NormalMembershipProductPriceDiscountCalculator;
use App\Services\SilverMembershipProductPriceDiscountCalculator;

return [

    /*
    |-----------------------------------------------------------
    | Product price discount based on user membership paths.
    |-----------------------------------------------------------
    |
    | Product price discount based on user membership.
    */
    'based_on_user_membership' => [
        'normal' => NormalMembershipProductPriceDiscountCalculator::class,
        'silver' => SilverMembershipProductPriceDiscountCalculator::class,
        'gold' => GoldMembershipProductPriceDiscountCalculator::class,
    ],
];
