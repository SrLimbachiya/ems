<?php

namespace components;

use app\models\CityMaster;
use app\models\CountryMaster;
use app\models\Departments;
use app\models\Designations;
use app\models\StateMaster;
use app\models\User;
use Ramsey\Uuid\Uuid;

class HelperComponent
{

    /*
     * Returns a universal unique id.
     *
     * @return Uuid string
     */
    public static function generateId()
    {
        return self::generate();
    }

    /*
     * Generate a version 5 UUID based on the SHA-1 hash of a namespace
     * identifier (which is a UUID) and a name (which is a string).
     *
     * @return Uuid string
     *
     */
    private static function generate()
    {
        return Uuid::uuid5(Uuid::NAMESPACE_DNS, self::generateRandomString() . Uuid::uuid4()->toString())->toString();
    }

    /*
     * Generate a random string with specified length.
     *
     * @param int $length
     *
     * @return String
     *
     */
    private static function generateRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function resolveDataByAttributeName($attributeName, $value)
    {

        $data = '';
        switch ($attributeName) {
            case 'employee_id':
            case 'user_id':
                $data = User::findIdentity($value);
                break;
            case 'department':
                $data = Departments::resolveDepartmentName($value);
                break;
            case 'designation':
                $data = Designations::resolveDesignationName($value);
                break;
            case 'country':
                $data = CountryMaster::getCountryById($value);
                break;
            case 'state':
                $data = StateMaster::getStateById($value);
                break;
            case 'city':
                $data = CityMaster::getCityById($value);
                break;
            default:
                $data = $value;
        }
        return $data;
    }
}