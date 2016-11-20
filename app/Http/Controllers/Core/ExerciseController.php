<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/16/2016
 * Time:    8:20 PM
 **/

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Comparison;
use App\Models\DataTypes\FuzzyNumber;
use App\Models\Evaluator;
use App\Models\Exercise;
use App\Models\FCV;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ExerciseController
 *
 * @package App\Http\Controllers
 */
class ExerciseController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function getExerciseList(Request $request)
    {
        $exercises = Exercise::all();
        $total = $exercises->count();
        parseListRange($request, $exercises->count(), $from, $to, 200);
        $list = $exercises->take($to - $from + 1); //adding 1 makes the range inclusive

        return ['net_total' => $total, 'list' => $list];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getResultsList(Request $request)
    {
        /**
         * @var Collection $exercises
         */
        $exercises = Exercise::where('state', Exercise::IS_PUBLISHED)->get();
        $total = $exercises->count();
        parseListRange($request, $exercises->count(), $from, $to, 200);
        $list = $exercises->take($to - $from + 1); //adding 1 makes the range inclusive

        return ['net_total' => $total, 'list' => $list];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getLiveList(Request $request)
    {
        /**
         * @var Collection $exercises
         */
        $exercises = Exercise::allLive()->get();
        $total = $exercises->count();
        parseListRange($request, $exercises->count(), $from, $to, 200);
        $list = $exercises->take($to - $from + 1); //adding 1 makes the range inclusive

        return ['net_total' => $total, 'list' => $list];
    }

    /**
     * @param Exercise $exercise
     *
     * @return array
     */
    public function getExerciseRelations(Exercise $exercise)
    {
        return [
            'status' => true,
            'object' => [
                'id' => $exercise->id,
                'main' => $exercise,
                'relations' => [
                    'fcvs' => $exercise->fcvs()->getResults()->sortBy(function (FCV $FCV) {
                        return (new FuzzyNumber($FCV->value))->defuzzify();
                    }),
                    'comments' => $exercise->comments()->getResults()->sortByDesc('grade'),
                    'factors' => $exercise->factors()->getResults()->sortByDesc('weight'),
                    'subjects' => $exercise->subjects()->getResults(),
                    'evaluators' => $exercise->evaluators()->getResults(),
                ],
            ],
        ];
    }

    /**
     * Initialize a new evaluation Exercise
     *
     * @param Request $request
     *
     * @return string
     */
    public function create(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * Set Factor Hierarchy for a given exercise
     *
     * @param Request $request
     *
     * @return string
     */
    public function setFactors(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * Set Fuzzy Comparison Variables for Factor Comparisons
     * The FCV ids are passed through a post request
     *
     * @param Request $request
     *
     * @return string
     */
    public function setFuzzyCVs(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * Set evaluation comment set for an Exercise
     *
     * @param Request $request
     *
     * @return string
     */
    public function setComments(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * Set exercise evaluators by passing an array of user ids and their respective evaluation roles through a post request
     * Evaluation roles could be
     *      1. Factor Comparison
     *      2. Subject Evaluation
     *
     * @param Request $request
     *
     * @return string
     */
    public function setEvaluators(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * Set exercise subjects by passing an array of user ids through a post request
     *
     * @param Request $request
     *
     * @return string
     */
    public function setSubjects(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * @param Evaluator $evaluator
     * @param Subject $subject
     * @param array $evaluations
     */
    public function saveSubjectEvaluation(Evaluator $evaluator, Subject $subject, array $evaluations)
    {
        $evaluator->evaluations()->where('subject_id', $subject->id)->delete();

        foreach ($evaluations as $factorId => $commentId) {
            $evaluator->evaluations()->create(['subject_id' => $subject->id, 'factor_id' => $factorId, 'comment_id' => $commentId]);
        }
    }

    public function saveFactorComparisons(Evaluator $evaluator, array $comparisons)
    {
        $C = [];

        try {
            foreach ($comparisons as $FX_ID => $FX_Comparisons) {
                foreach ($FX_Comparisons as $FY_ID => $FCV_ID) {
                    $C[] = new Comparison([
                        'f1_id' => $FX_ID,
                        'f2_id' => $FY_ID,
                        'fcv__id' => $FCV_ID,
                        'evaluator_id' => $evaluator->id
                    ]);
                }
            }

            $evaluator->comparisons()->saveMany($C);

            return true;
        }
        catch (\Exception $exception) {
            return false;
        }
    }
}
