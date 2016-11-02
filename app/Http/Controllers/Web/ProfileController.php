<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    8:17 PM
 **/

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showOrGet()
    {
        return ['title'=>'Profile Page'];
    }

    public function update(Request $request)
    {

    }

    public function photo(Request $request)
    {

    }

    public function password(Request $request)
    {

    }
}
