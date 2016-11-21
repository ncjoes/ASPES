<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/21/2016
 * Time:    2:58 AM
 **/

namespace App\Models\Helpers;

use App\Models\DataTypes\FuzzyNumber;

/**
 * Class FuzzyAHP
 *
 * @package App\Models\Helpers
 */
trait FuzzyAHP
{
    /**
     * @param $fuzzyMatrix
     * @return array
     */
    protected function defuzzifyComparisonMatrix($fuzzyMatrix)
    {
        foreach ($fuzzyMatrix as $rowId => $column) {
            /**
             * @var FuzzyNumber $item
             */
            foreach ($column as $columnId => $item) {
                $fuzzyMatrix[ $rowId ][ $columnId ] = $item->defuzzify(8);
            }
        }

        return $fuzzyMatrix;
    }

    /**
     * @param array $matrix
     *
     * @return float|int
     * @throws \Exception
     */
    protected function calcConsistencyIndex(array $matrix)
    {
        $N = count($matrix);
        if ($N > 1) {
            $eigenvalues = $this->calcEigenvalues($matrix);

            return ((max($eigenvalues) - $N) / ($N - 1));
        }

        throw new \Exception("Can not compute eigenvalues for a matrix of dimension {$N}");
    }

    /**
     * @param array $matrix
     *
     * @return array
     */
    protected function calcEigenvalues(array $matrix)
    {
        //ToDo
        // use numpy package to compute eigenvalues
        return $this->randomArray(count($matrix), -2, 2);
    }

    /**
     * @param $order
     *
     * @return float|int|mixed
     */
    protected function randomConsistencyIndex($order)
    {
        $knowCI = [
            '3' => 0.58,
            '4' => 0.9,
            '5' => 1.12,
            '6' => 1.24,
            '7' => 1.32,
            '8' => 1.41,
            '9' => 1.45
        ];
        $order = (string)$order;
        if (array_key_exists($order, $knowCI)){
            return $knowCI[ $order ];
        }
        return $this->calcConsistencyIndex($this->randomMatrix($order));
    }

    /**
     * @param $order
     *
     * @return array
     */
    protected function randomMatrix($order)
    {
        $order = (int)$order;
        $M = [];
        for ($i = 0; $i < $order; ++$i) {
            $diff = rand(0, 99);
            $M[0] = $this->randomArray($order, $order - $diff, $order + $diff);
        }

        return $M;
    }

    /**
     * @param $size
     * @param int $min
     * @param int $max
     *
     * @return array
     */
    protected function randomArray($size, $min = 0, $max = 99)
    {
        if (($max - $min) < $size) {
            $max = $min + $size;
        }
        $arr = range($min, $max);
        shuffle($arr);

        return array_slice($arr, 0, $size);
    }
}
