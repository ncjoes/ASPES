<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    2:54 PM
 **/

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class PublicController
{
    public function home()
    {
        return view('public.home');
    }

    public function listLiveExercises(Request $request)
    {
        return view('public.live_exercises');
    }

    public function listResults(Request $request)
    {
        return view('public.results');
    }

    public function viewResult(Request $request)
    {
        return view('public.result');
    }
}
