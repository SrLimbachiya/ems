<?php

namespace components;

class Masters
{

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const EMP_TYPE_PERMANENT = 'PERMANENT';
    const EMP_TYPE_CONTRACTUAL = 'CONTRACTUAL';

    public static function getStatus() {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public static function getEmployeeTypes() {
        return [
            self::EMP_TYPE_PERMANENT => 'Permanent',
            self::EMP_TYPE_CONTRACTUAL => 'Contractual',
        ];
    }

    public static function getGenders() {
        return ['Male', 'Female', 'Other'];
    }

   public static function getCategory() {
        return ['Unreserved', 'OCB', 'SC', 'ST'];
    }

}