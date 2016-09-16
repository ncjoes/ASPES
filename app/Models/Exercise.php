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

/**
 * Class Exercise
 * @package App\Models
 */
class Exercise extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     *
     */
    const ER_SUBJECT   = 'subjects';
    /**
     *
     */
    const ER_EVALUATOR = 'evaluators';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fcvs()
    {
        return $this->hasMany('App\Models\FCV');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factors()
    {
        return $this->hasMany('App\Models\Factor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluators()
    {
        return $this->hasMany('App\Models\Evaluator');
    }

    /**
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function concerned_users($role=self::ER_EVALUATOR)
    {
        return $this->belongsToMany('App\Models\User', $role);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function factor_comparisons()
    {
        return $this->hasManyThrough('App\Models\Comparison', 'App\Models\Evaluator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subject_evaluations()
    {
        return $this->hasManyThrough('App\Models\Evaluation', 'App\Models\Subject');
    }

    /**
     * @return array
     */
    public function _getComparisonMatrices()
    {
        $data = [];
        return $data;
    }

    /**
     * @return array
     */
    public function _getRepresentativeCM()
    {
        $data = [];
        return $data;
    }

    /**
     * @return array
     */
    public function getFactorWeights()
    {
        $data = [];
        return $data;
    }
}