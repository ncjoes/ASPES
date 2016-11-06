<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/16/2016
 * Time:    8:20 PM
 **/

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\DataTypes\FuzzyNumber;
use App\Models\Exercise;
use App\Models\FCV;
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
        $exercises = Exercise::where('concluded', 1)->get();
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
                    'fcvs' => $exercise->fcvs()->getResults()->sortBy(function (FCV $FCV){
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
     * @param Request $request
     *
     * @return string
     */
    public function compareFactors(Request $request)
    {
        $data = [];

        return $data;
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function evaluateSubject(Request $request)
    {
        $data = [];

        return $data;
    }
}
