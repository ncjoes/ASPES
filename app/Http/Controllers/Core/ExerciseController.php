<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/16/2016
 * Time:    8:20 PM
 **/

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ExerciseController
 * @package App\Http\Controllers
 */
class ExerciseController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $data = ['test'=>'yes, am working. what were you thinking?'];
        return $data;
    }

    /**
     * Initialize a new evaluation Exercise
     *
     * @param Request $request
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
     * @return string
     */
    public function setFuzzyCVs(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * Set evaluation comment set for an Exercise
     * @param Request $request
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
     * @return string
     */
    public function setSubjects(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function compareFactors(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function evaluateSubject(Request $request)
    {
        $data = [];
        return $data;
    }
}