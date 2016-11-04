<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    2:54 PM
 **/

namespace App\Http\Controllers\Web;

class PublicController
{
    public function showHomepage()
    {
        return view('public.home');
    }
}
