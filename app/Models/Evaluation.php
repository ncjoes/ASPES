<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:13 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function evaluator()
    {
        return $this->belongsTo('App\Models\Evaluator');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    public function factor()
    {
        return $this->belongsTo('App\Models\Factor');
    }
}