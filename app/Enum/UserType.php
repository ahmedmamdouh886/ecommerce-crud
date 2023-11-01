<?php

namespace App\Enum;

enum UserType: string {
    /**
     * Normal user type.
     * 
     * @var string.
     */
    case NORMAL = "normal";

    /**
     * Silver user type.
     * 
     * @var string.
     */
    case SILVER = "silver";

    /**
     * Gold user type.
     * 
     * @var string.
     */
    case GOLD = "gold";

    /**
     * Get enum values.
     * 
     * @return array
     */
    public static function values() {
        return array_column(self::cases(), 'value');
    }
}
