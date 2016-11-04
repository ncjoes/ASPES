<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:09 PM
 **/

namespace App\Models;

use App\Models\DataTypes\FuzzyNumber;
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
    protected $dates = ['deleted_at', 'start_at', 'stop_at'];
    protected $casts = ['published', 'concluded'];

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

    public function factor_evaluators()
    {
        return $this->evaluators()->where('type', Evaluator::DM);
    }

    public function subject_evaluators()
    {
        return $this->evaluators()->where('type', Evaluator::SE);
    }

    /**
     * @return array
     */
    public function getComparisonMatrices()
    {
        $matrices = [];
        /**
         * @var Evaluator $evaluator
         */
        foreach ($this->factor_evaluators()->get() as $evaluator) {
            $matrices[ $evaluator->id ] = $evaluator->getComparisonMatrix();
        }

        return $matrices;
    }

    /**
     * @return array
     */
    public function buildDecisionMatrix()
    {
        $decisionMatrix = [];
        $comparisonMatrices = $this->getComparisonMatrices();

        $factorsMatrix = [];
        foreach ($comparisonMatrices as $evaluator_id => $comparisonMatrix) {
            foreach ($comparisonMatrix as $factor1_id => $comparisons) {
                foreach ($comparisons as $factor2_id=>$fuzzyNumber) {
                    $factorsMatrix[$factor1_id][$factor2_id][$evaluator_id] = $fuzzyNumber;
                }
            }
        }

        foreach ($factorsMatrix as $factor1_id => $crossComparisons) {
            foreach ($crossComparisons as $factor2_id=>$fuzzyNumbers) {
                $decisionMatrix[$factor1_id][$factor2_id] = FuzzyNumber::geometricMean($fuzzyNumbers);
            }
        }

        return $decisionMatrix;
    }

    /**
     * @return array
     */
    public function getFactorWeights()
    {
        $matrix = [];

        return $matrix;
    }
}
