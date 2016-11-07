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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('public.home');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listLiveExercises(Request $request)
    {
        return view('public.live');
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
}
