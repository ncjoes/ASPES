<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    6:20 PM
 **/

namespace App\Models\DataTypes;

class FuzzyNumber
{
    protected $l;
    protected $m;
    protected $u;
    protected $triple;

    public function __construct(array $array)
    {
        if (self::checkIsTriple($array)) {
            $this->l = $array[0];
            $this->m = $array[1];
            $this->u = $array[2];
            $this->triple = $array;

            return $this;
        }
        throw new \InvalidArgumentException("Not a triple");
    }

    public function L() { return $this->l; }

    public function M() { return $this->m; }

    public function U() { return $this->u; }

    public function isTFN()
    {
        return self::checkIfTFN($this->triple);
    }

    public function addTo(self $fuzzyNumber)
    {
        return self::add($this, $fuzzyNumber);
    }

    public function multiplyWith(self $fuzzyNumber)
    {
        return self::multiply($this, $fuzzyNumber);
    }

    public function divideBy(self $fuzzyNumber)
    {
        return self::divide($this, $fuzzyNumber);
    }

    public function inverse()
    {
        return self::invert($this);
    }

    public static function add(self $fzn1, self $fzn2)
    {
        return new self([
            $fzn1->L() + $fzn2->L(),
            $fzn1->M() + $fzn2->M(),
            $fzn1->U() + $fzn2->U()
        ]);
    }

    public static function multiply(self $fzn1, self $fzn2)
    {
        return new self([
            $fzn1->L() * $fzn2->L(),
            $fzn1->M() * $fzn2->M(),
            $fzn1->U() * $fzn2->U()
        ]);
    }

    public static function divide(self $fzn1, self $fzn2)
    {
        return new self([
            $fzn1->L() / $fzn2->L(),
            $fzn1->M() / $fzn2->M(),
            $fzn1->U() / $fzn2->U()
        ]);
    }

    public static function invert(self $fuzzyNumber)
    {
        return new self([
            1 / $fuzzyNumber->L(),
            1 / $fuzzyNumber->M(),
            1 / $fuzzyNumber->U()
        ]);
    }

    public static function checkIsTriple(array $array)
    {
        return (isset($array[0]) and isset($array[1]) and isset($array[2]) and sizeof($array) === 3);
    }

    public static function checkIfTFN(array $arr)
    {
        return self::checkIsTriple($arr) and ($arr[0] !== $arr[1] and $arr[0] !== $arr[2] and $arr[1] !== $arr[2]);
    }
}
