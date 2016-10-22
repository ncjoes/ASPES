<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/9/2016
 * Time:    9:08 PM
 **/
$x = "[0-9]{7}";
return [
    '_code_'   => ['234'],
    'carriers' => [
        'etisalat' => ['809'.$x, '807'.$x, '819'.$x, '817'.$x, '818'.$x, '808'.$x, '708'.$x, '900'.$x, '909'.$x],
        'globacom' => ['805'.$x, '815'.$x, '705'.$x, '905'.$x],
        'mtn'      => ['803'.$x, '806'.$x, '813'.$x, '816'.$x, '811'.$x, '814'.$x, '703'.$x, '706'.$x, '903'.$x],
        'other'    => ['802'.$x, '812'.$x, '810'.$x, '701'.$x],
    ],
];
