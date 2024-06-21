<?php

namespace App\Helpers;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Brick\PhoneNumber\PhoneNumberParseException;

class PhoneNumberHelper
{
    public static function format($number, $countryCode = 'ID')
    {
        // Check if the phone number is null or empty
        if (is_null($number) || empty($number)) {
            return '-'; // Return a dash or any default value for null/empty numbers
        }

        try {
            $phoneNumber = PhoneNumber::parse($number, $countryCode);
            return $phoneNumber->format(PhoneNumberFormat::INTERNATIONAL);
        } catch (PhoneNumberParseException $e) {
            // If there's an error parsing the phone number, return the original number
            return $number;
        }
    }
}
