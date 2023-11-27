<?php

namespace App\Utils;

class Hider
{
    /**
     * Partially hide email address
     * 
     * @return string
     */
    public static function hideEmail(string $email): string {
        $explodedStr = explode("@",$email);
        
        $name = $explodedStr[0];
        $length = strlen($name);
        $showLength = floor($length / 2);
        $strArr = str_split($name);

        for ($i = $showLength; $i < $length; $i++) {
            $strArr[$i] = '*';
        }
        
        $explodedStr[0] = implode('', $strArr); 
        $newEmail = implode('@', $explodedStr);

        return $newEmail;
    }

    /**
     * Partially hide phone number
     * 
     * @return string
     */
    public static function hidePhoneNumber(string $phoneNumber): string {
        $length = strlen($phoneNumber);
        $showLength = floor($length / 2);
        $strArr = str_split($phoneNumber);

        for ($i = $showLength; $i < $length; $i++) {
            $strArr[$i] = '*';
        }
        
        $newphoneNumber = implode('', $strArr); 

        return $newphoneNumber;
    }
}
