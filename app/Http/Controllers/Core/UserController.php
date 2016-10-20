<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/16/2016
 * Time:    9:12 PM
 **/

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function updateInfo(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function changePassword(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getUsers(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function blockUsers(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function unblockUsers(Request $request)
    {
        $data = [];
        return $data;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function setUserRoles(Request $request)
    {
        $data = [];
        return $data;
    }
}