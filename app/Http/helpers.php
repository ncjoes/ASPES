<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/17/2016
 * Time:    2:37 PM
 **/

/**
 * @param $controller
 * @param $method
 * @param array $args
 * @param $namespace
 * @return mixed
 */
function delegate($controller, $method, $args=[], $namespace='App\Http\Controllers')
{
    return app()->make($namespace."\\".$controller)->callAction($method, $args);
}