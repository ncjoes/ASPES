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
    protected $casts  = [
        'decision_matrix' => 'array',
        'factor_weights' => 'array',
        'results' => 'array'
    ];
    protected $hidden = ['decision_matrix', 'factor_weights', 'results'];

    const ER_SUBJECT   = 'subjects';
    const ER_EVALUATOR = 'evaluators';

    const IS_LIVE      = 1;
    const IS_DRAFT     = 2;
    const IS_PUBLISHED = 3;

    /**
     * @return array
     */
    public static function states()
    {
        return [
            self::IS_LIVE => 'Live',
            self::IS_DRAFT => 'Draft',
            self::IS_PUBLISHED => 'Published'
        ];
    }

    /**
     * @return bool
     */
    public function isLive()
    {
        return $this->state === self::IS_LIVE;
    }

    /**
     * @return bool
     */
    public function isDraft()
    {
        return $this->state === self::IS_DRAFT;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->state === self::IS_PUBLISHED;
    }

    /**
     * @return mixed
     */
    public static function allLive()
    {
        return self::where('state', self::IS_LIVE);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function invitedUsers()
    {
        return $this->hasManyThrough(User::class, Invitation::class);
    }

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
        $builder = $this->belongsToMany(User::class, $role);

        return $role == self::ER_EVALUATOR ? $builder : $builder->withPivot(['id', 'evaluation_matrix']);
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
        if ($this->isPublished()) {
            $arr = $this->decision_matrix;
            if (!is_array($arr)) {
                $arr = $this->decision_matrix = $this->buildDecisionMatrix();
                $this->save();
            }

            return $arr;
        }

        $arr = $this->decision_matrix = $this->buildDecisionMatrix();
        $this->save();

        return $arr;
    }

    /**
     * @return array
     */
    public function getFactorWeights()
    {
        if ($this->isPublished()) {
            $arr = $this->factor_weights;
            if (!is_array($this->factor_weights)) {
                $arr = $this->factor_weights = $this->calculateFactorWeights();
                $this->save();
            }

            return $arr;
        }

        $arr = $this->factor_weights = $this->calculateFactorWeights();
        $this->save();

        return $arr;
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
     * @return array
     */
    public function getResults()
    {
        if ($this->isPublished()) {
            $results = $this->results;
            if (!is_array($results)) {
                $results = $this->results = $this->calculateResults();
                $this->save();
            }

            return $results;
        }

        $results = $this->results = $this->calculateResults();
        $this->save();

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
     * @return array
     * @throws \Exception
     */
    protected function calculateResults()
    {
        $results = [];
        $FactorWeights = $this->getFactorWeights();
        /**
         * @var Subject $subject
         */
        foreach ($this->subjects as $subject) {
            try {
                $results[ $subject->id ] = $this->vectorDotMatrix($FactorWeights, $subject->getEvaluationMatrix());
            }
            catch (\Exception $e) {
                throw new \Exception("Calculations failed. This happens due to corrupt data. Please contact Joe @ (jcnwobodo@gmail.com)");
            }
        }

        return $results;
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
            foreach ($column as $columnId => $cell) {
                $matrixCols[ $j ] = $columnId;
                $M[ $j ][ $i ] = $cell;
                $j++;
            }
            $i++;
        }

        $VECTOR = (new NumArray($V));
        $MATRIX = (new NumArray($M));
        $vDotM = $MATRIX->dot($VECTOR)->getData();

        $RESULT = [];
        foreach ($vDotM as $j => $value) {
            $RESULT[ $matrixCols[ $j ] ] = round($value, 3);
        }

        return $RESULT;
    }
}
