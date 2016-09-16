<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:28 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function exercise()
    {
        return $this->belongsTo('App\Models\Exercise');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }

    public function comparisons()
    {
        return $this->hasMany('App\Models\Comparison', 'f1_id');
    }

    public function parent()
    {
        return $this->find($this->parent_id);
    }

    public function sub_factors()
    {
        return $this->where('parent_id', $this->id);
    }
}