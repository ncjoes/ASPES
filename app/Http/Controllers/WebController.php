<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/20/2016
 * Time:    5:15 PM
 **/

namespace App\Http\Controllers;

class WebController extends Controller
{
    public function showAppConsole()
    {
        return $this->showAppRoutes();
    }

    public function showAppRoutes()
    {
        $data['routes'] = \Route::getRoutes();
        $data['text'] = "ASPES - App. Routes! &lt;/&gt;, <br/>Work in progress...";

        return view('_tools.routes', $data);
    }


    public function showAppHome()
    {
        if (\Auth::guest()) {
            return $this->showPublicHome();
        }

        return $this->showAccountHome();
    }

    public function showPublicHome()
    {
        $data = run_action('AppController@prepGuestHomepage', 'Core');

        return view('home_guest', $data);
    }

    public function showAccountHome()
    {
        $data = run_action('AppController@prepUserHomepage', 'Core');

        return view('home_user', $data);
    }

}