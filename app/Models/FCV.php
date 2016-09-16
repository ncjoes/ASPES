<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:33 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FCV extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function exercise()
    {
        return $this->belongsTo('App\Models\Exercise');
    }

    public function comparisons()
    {
        return $this->hasMany('App\Models\Comparison');
    }
}