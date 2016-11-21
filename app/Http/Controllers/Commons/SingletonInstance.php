<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/21/2016
 * Time:    3:27 AM
 **/

namespace App\Http\Controllers\Commons;

/**
 * Class SingletonInstance
 *
 * @package App\Http\Controllers\Commons
 */
trait SingletonInstance
{
    /**
     * @return self
     */
    public static function instance()
    {
        static $self;

        if (!is_object($self)) {
            $self = new self;
        }

        return $self;
    }
}
