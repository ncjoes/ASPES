<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    2:54 PM
 **/

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Core\ExerciseController;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class PublicController
 *
 * @package App\Http\Controllers\Web
 */
class PublicController
{
    /**
     * @var
     */
    protected $ExerciseController;

    /**
     * @return ExerciseController
     */
    protected function EC()
    {
        if (!is_object($this->ExerciseController)) {
            $this->ExerciseController = new ExerciseController;
        }

        return $this->ExerciseController;
    }

    public function home(Request $request)
    {
        $data['live_exercises'] = Exercise::allLive()->get();
        $data['listed_as_evaluator'] = [];
        $data['listed_as_subject'] = [];
        if(!\Auth::guest()){
            /**
             * @var User $user
             */
            $user = $request->user();
            $data['listed_as_evaluator'] = $user->exercises(User::ER_EVALUATOR)->wherePivot('done', 0)->getResults()->unique();
            $data['listed_as_subject'] = $user->exercises(User::ER_SUBJECT)->getResults()->reject(function ($exercise){
                return !$exercise->isLive();
            })->unique();
        }

        return view('public.home', $data);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listLiveExercises(Request $request)
    {
        if ($request->has('id')) {
            return redirect()->route('app.results.view', ['id' => $request->input('id')]);
        }

        $data = $this->EC()->getLiveList($request);

        return iResponse('public.live', $data);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function listResults(Request $request)
    {
        if ($request->has('id')) {
            return redirect()->route('app.results.view', ['id' => $request->input('id')]);
        }

        $data = $this->EC()->getResultsList($request);

        return iResponse('public.results', $data);
    }

    /**
     * @param $id
     *
     * @return mixed|void
     */
    public function viewResult($id)
    {
        /**
         * @var Exercise $exercise
         */
        if (is_object($exercise = Exercise::find($id)) and ($exercise->isPublished() or $exercise->isLive())) {
            $data = $this->EC()->getResultsList(request());
            $data = array_merge($data, $this->EC()->getExerciseRelations($exercise));

            return iResponse('public.result', $data);
        }

        return abort(404);
    }

    /**
     * @param $id
     *
     * @return mixed|void
     */
    public function showEvaluationForm($id)
    {
        /**
         * @var Exercise $exercise
         */
        if (is_object($exercise = Exercise::find($id))){//} and $exercise->isLive()) {
            $data = $this->EC()->getExerciseRelations($exercise);

            return iResponse('public.evaluator', $data);
        }

        return abort(404);
    }
}
