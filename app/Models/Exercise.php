<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:09 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    const ER_SUBJECT = 'subjects';
    const ER_EVALUATOR = 'evaluators';

    public function fcvs()
    {
        return $this->hasMany('App\Models\FCV');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function factors()
    {
        return $this->hasMany('App\Models\Factor');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }

    public function evaluators()
    {
        return $this->hasMany('App\Models\Evaluator');
    }

    public function users($role=self::ER_EVALUATOR)
    {
        return $this->belongsToMany('App\Models\User', $role);
    }
}