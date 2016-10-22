<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/9/2016
 * Time:    9:05 PM
 **/

/**
 * @param $phone
 * @param $country
 *
 * @return bool
 */
function is_phone($phone, $country = 'ng')
{
    $patterns = is_file("phone/{$country}.php") ? require_once "phone/{$country}.php" : [];

    if (isset($patterns['_code_']) and isset($patterns['carriers'])) {
        $formats = [];
        foreach ($patterns['carriers'] as $carrier) {
            $formats = array_merge($formats, $carrier);
        }

        foreach ($formats as $format) {
            if (
                preg_match("/^(".$patterns['_code_'].")(".$format.")$/", $phone)
                or
                preg_match("/^(\\+".$patterns['_code_'].")(".$format.")$/", $phone)
            )
                return true;
        }
    }

    return false;
}

function normalize_phone($phone, $country = 'ng')
{
    /*
    if (is_phone($phone, $country)) {
        if (strlen($phone) == 11) {
            return $country_code.substr($phone, 1);
        }
        if (strlen($phone) == 14) {
            return substr($phone, 1);
        }

        return $phone;
    }
    throw new \Exception("Invalid phone number: {$phone}");
    */
}

