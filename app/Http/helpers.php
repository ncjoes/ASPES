<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/17/2016
 * Time:    2:37 PM
 **/

/**
 * @param $view
 * @param $data
 *
 * @return mixed
 */
function iResponse($view, $data)
{
    if (request()->wantsJson()) {
        return response()->json($data);
    }

    return view($view, $data);
}
