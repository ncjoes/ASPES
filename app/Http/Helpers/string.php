<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/9/2016
 * Time:    9:34 PM
 **/

/**
 * @param mixed $find
 * @param mixed $replacements
 * @param mixed $subject
 *
 * @return mixed
 */
function str_replace_recursive($find, $replacements, $subject)
{
    $num_replacements = 0;
    $subject = str_replace($find, $replacements, $subject, $num_replacements);
    if ($num_replacements == 0)
        return $subject;
    else
        return str_replace_recursive($find, $replacements, $subject);
}

/**
 * @param $mixed
 *
 * @return bool
 */
function is_json($mixed)
{
    return (is_string($mixed) and json_decode($mixed) and json_last_error() == JSON_ERROR_NONE);
}

function is_name($name, $numbers_allowed = false)
{
    if ($numbers_allowed)
        return preg_match("/^[a-zA-Z0-9 ]*$/", $name);
    else
        return preg_match("/^[a-zA-Z ]*$/", $name);
}

function normalizeUrl($url)
{
    return str_replace('\\', '/', $url);
}

function normalizePath($path)
{
    return str_replace('/', '\\', $path);
}

/**
 * Fancifully converts numbers to a more human friendly format. e.g 1000 = 1K
 * and 1000000 = 1M
 * @param float $number
 * @return string
 */
function fancyCount($number)
{
    $sizes = array('K', 'M', 'B', 'Z');
    if ($number < 1000) {
        return $number;
    }
    $i = intval(floor(log($number) / log(1000)));
    return round($number / pow(1000, $i), 2) . $sizes[$i - 1];
}
