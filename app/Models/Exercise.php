<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:09 PM
 **/

namespace App\Models;

use App\Models\DataTypes\FuzzyNumber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nubs\Vectorix\Vector;
use NumPHP\Core\NumArray;

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
    protected $dates  = ['deleted_at', 'start_at', 'stop_at'];
    protected $casts  = ['published' => 'boolean', 'concluded' => 'boolean', 'decision_matrix' => 'array', 'factor_weights' => 'array'];
    protected $hidden = ['decision_matrix', 'factor_weights'];

    const ER_SUBJECT   = 'subjects';
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
     * @return Builder
     */
    public function factor_evaluators()
    {
        return $this->evaluators()->where('type', Evaluator::DM);
    }

    /**
     * @return Builder
     */
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
    public function getDecisionMatrix()
    {
        if (!$this->concluded) {
            $this->decision_matrix = $this->buildDecisionMatrix();
            $this->save();
        }

        return $this->decision_matrix;
    }

    /**
     * @return array
     */
    public function getFactorWeights()
    {
        if (!$this->concluded) {
            $this->factor_weights = $this->calculateFactorWeights();
            $this->save();
        }

        return $this->factor_weights;
    }

    /**
     * @param Subject|null $subject
     *
     * @return array
     */
    public function getEvaluationMatrix(Subject $subject = null)
    {
        $matrices = [];
        if (is_object($subject)) {
            $matrices[ $subject->id ] = $subject->getEvaluationMatrix();
        }
        else {
            /**
             * @var Subject $subject
             */
            foreach ($this->subjects as $subject) {
                $matrices[ $subject->id ] = $subject->getEvaluationMatrix();
            }
        }

        return $matrices;
    }

    /**
     * @param Subject|null $subject
     *
     * @return array
     */
    public function getResult(Subject $subject = null)
    {
        $results = [];
        $FactorWeights = $this->getFactorWeights();
        if (is_object($subject)) {
            $results[ $subject->id ] = $this->vectorDotMatrix($FactorWeights, $subject->getEvaluationMatrix());
        }
        else {
            /**
             * @var Subject $subject
             */
            foreach ($this->subjects as $subject) {
                $results[ $subject->id ] = $this->vectorDotMatrix($FactorWeights, $subject->getEvaluationMatrix());
            }
        }

        return $results;
    }


    //-----------CALCULATIONS-----------------------------------------------//
    /**
     * @return array
     */
    protected function buildDecisionMatrix()
    {
        $decisionMatrix = [];
        $comparisonMatrices = $this->getComparisonMatrices();

        $factorsMatrix = [];
        foreach ($comparisonMatrices as $evaluator_id => $comparisonMatrix) {
            foreach ($comparisonMatrix as $factor1_id => $comparisons) {
                foreach ($comparisons as $factor2_id => $fuzzyNumber) {
                    $factorsMatrix[ $factor1_id ][ $factor2_id ][ $evaluator_id ] = $fuzzyNumber;
                }
            }
        }

        foreach ($factorsMatrix as $factor1_id => $crossComparisons) {
            foreach ($crossComparisons as $factor2_id => $fuzzyNumbers) {
                $decisionMatrix[ $factor1_id ][ $factor2_id ] = FuzzyNumber::AIJ($fuzzyNumbers);
            }
        }

        return $decisionMatrix;
    }

    /**
     * @return array
     */
    protected function calculateFactorWeights()
    {
        $matrix = [];
        /**
         * @var Factor $factor
         */
        foreach ($this->factors as $factor) {
            $matrix[ $factor->id ] = $factor->getRawWeight();
        }
        $normalized = (new Vector($matrix))->normalize()->components();
        foreach ($normalized as $key => $value) {
            $normalized[ $key ] = round($value, 3);
        }
        foreach ($this->factors as $factor) {
            $factor->weight = $normalized[ $factor->id ];
            $factor->save();
        }

        return $normalized;
    }

    /**
     * @param array $vector
     * @param array $matrix
     *
     * @return array
     */
    protected function vectorDotMatrix(array $vector, array $matrix)
    {
        $V = array_values($vector);
        $matrixCols = [];
        $M = [];

        $i = $j = 0;
        foreach ($matrix as $column) {
            $j = 0;
            foreach ($column as $columnId=>$cell) {
                $matrixCols[$j] = $columnId;
                $M[$j][$i] = $cell;
                $j++;
            }
            $i++;
        }

        $VECTOR = (new NumArray($V));
        $MATRIX = (new NumArray($M));
        $vDotM = $MATRIX->dot($VECTOR)->getData();

        $RESULT = [];
        foreach ($vDotM as $j=>$value) {
            $RESULT[$matrixCols[$j]] = $value;
        }

        return $RESULT;
    }
}
