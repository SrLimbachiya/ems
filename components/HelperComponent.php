<?php

namespace components;

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
}