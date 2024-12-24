<?php

namespace components;

class Masters
{

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const EMP_TYPE_PERMANENT = 'Permanent';
    const EMP_TYPE_CONTRACTUAL = 'Contractual';

    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';
    const GENDER_OTHER = 'Other';



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
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
            self::GENDER_OTHER => 'Other',
        ];
    }

    const SOCIAL_CATEGORY_UNRESERVED = 'Unreserved';
    const SOCIAL_CATEGORY_OBC = 'OBC';
    const SOCIAL_CATEGORY_SC = 'SC';
    const SOCIAL_CATEGORY_ST = 'ST';

   public static function getCategory() {
        return [
          self::SOCIAL_CATEGORY_UNRESERVED => 'Unreserved',
          self::SOCIAL_CATEGORY_OBC => 'OBC',
          self::SOCIAL_CATEGORY_SC => 'SC',
          self::SOCIAL_CATEGORY_ST => 'ST',
        ];
    }

}