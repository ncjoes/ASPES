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

class PublicController
{
    protected $ExerciseController;

    protected function EC()
    {
        if (!is_object($this->ExerciseController)) {
            $this->ExerciseController = new ExerciseController;
        }

        return $this->ExerciseController;
    }

    public function home()
    {
        return view('public.home');
    }

    public function listLiveExercises(Request $request)
    {
        return view('public.live');
    }

    public function listResults(Request $request)
    {
        if ($request->has('id')) {
            return redirect()->route('app.results.view', ['id' => $request->input('id')]);
        }

        $data = $this->EC()->getResultsList($request);

        return iResponse('public.results', $data);
    }

    public function viewResult($id)
    {
        /**
         * @var Exercise $exercise
         */
        if (is_object($exercise = Exercise::find($id)) and $exercise->concluded) {
                $data = $this->EC()->getResultsList(request());
                $data = array_merge($data, $this->EC()->getExerciseRelations($exercise));

                return iResponse('public.result', $data);
        }

        return abort(404);
    }
}
