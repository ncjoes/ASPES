<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    2:44 PM
 **/

namespace App\Http\Controllers;

class Tools
{
    public function showAppRoutes()
    {
        $data['routes'] = \Route::getRoutes();
        $data['text'] = "ASPES - App. Routes! &lt;/&gt;, <br/>Work in progress...";

        return view('_tools.routes', $data);
    }

    public function showWebConsole()
    {
        return $this->showAppRoutes();
    }

}