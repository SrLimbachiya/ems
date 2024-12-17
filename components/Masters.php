<?php

namespace components;

class Masters
{

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    public static function getStatus() {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public static function getGenders() {
        return ['Male', 'Female', 'Other'];
    }

   public static function getCategory() {
        return ['Unreserved', 'OCB', 'SC', 'ST'];
    }

}