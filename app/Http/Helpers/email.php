<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/9/2016
 * Time:    10:16 PM
 **/

/**
 * @param $email
 *
 * @return bool
 */
function is_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function normalize_email($email)
{
    if (is_email($email)) {
        $parts = explode('@', strtolower($email));
        switch ($parts['1']) {
            case 'gmail.com' : {
                $parts[0] = str_replace('.', '', $parts[0]);
            }
            break;
        }

        return implode('@', $parts);
    }
    throw new \Exception("Invalid email: {$email}");
}
