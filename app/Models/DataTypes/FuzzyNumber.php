<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    6:20 PM
 **/

namespace App\Models\DataTypes;

use NcJoes\FuzzyNumber\FuzzyNumber as Base;

/**
 * Class FuzzyNumber
 *
 * @package App\Models\DataTypes
 */
class FuzzyNumber extends Base
{
    /**
     * @param array $fuzzyNumbers
     * @param int $dp
     *
     * @return FuzzyNumber
     */
    public static function AIJ(array $fuzzyNumbers, $dp = 3)
    {
        if (self::checkIfMassActionable($fuzzyNumbers)) {
            return new self([
                min(self::getL($fuzzyNumbers)),
                self::GM(self::getM($fuzzyNumbers), $dp),
                max(self::getU($fuzzyNumbers))
            ]);
        }

        throw new self::$E("Array -{fuzzyNumbers}- must contain 2 or more FuzzyNumbers only \n".print_r($fuzzyNumbers, true));
    }
}
