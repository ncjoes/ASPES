<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/21/2016
 * Time:    12:49 PM
 **/

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function prepGuestHomepage(Request $request)
    {
        $arr = [];

        return $arr;
    }

    public function prepUserHomepage(Request $request)
    {
        $arr = [];

        return $arr;
    }

    public function prepAdminDashboard(Request $request)
    {
        $arr = [];

        return $arr;
    }
}