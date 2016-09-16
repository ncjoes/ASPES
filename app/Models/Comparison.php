<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:21 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comparison extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function factor1()
    {
        return $this->belongsTo('App\Models\Factor', 'f1_id');
    }

    public function factor2()
    {
        return $this->belongsTo('App\Models\Factor', 'f2_id');
    }

    public function fcv()
    {
        return $this->belongsTo('App\Models\FCV');
    }

    public function evaluator()
    {
        return $this->belongsTo('App\Models\Evaluator');
    }
}