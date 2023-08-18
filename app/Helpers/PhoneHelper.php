<?php

namespace App\Helpers;

class PhoneHelper
{
    public static function reformatRequestPhoneData(array &$validatedData, array $inputNames): array
    {
        foreach ($inputNames as $inputName) {
            $validatedData[$inputName] = str_replace(' ', '', $validatedData[$inputName]);
        }

        return $validatedData;
    }

    public static function reformatPhoneData($phoneString): string
    {
        return str_replace([' ', '*', '+', '-', '_', '/', '\\', '(', ')'], '', $phoneString);
    }
}
