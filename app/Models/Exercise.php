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
 *
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
    const ER_SUBJECT = 'subjects';
    /**
     *
     */
    const ER_EVALUATOR = 'evaluators';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fcvs()
    {
        return $this->hasMany(FCV::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factors()
    {
        return $this->hasMany(Factor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluators()
    {
        return $this->hasMany(Evaluator::class);
    }

    /**
     * @param string $role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function concerned_users($role = self::ER_EVALUATOR)
    {
        return $this->belongsToMany(User::class, $role);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function factor_comparisons()
    {
        return $this->hasManyThrough(Comparison::class, Evaluator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subject_evaluations()
    {
        return $this->hasManyThrough(Evaluation::class, Subject::class);
    }

    /**
     * @return array
     */
    public function getComparisonMatrices()
    {
        $data = [];

        return $data;
    }

    /**
     * @return array
     */
    public function getRepresentativeCM()
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