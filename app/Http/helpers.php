<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/17/2016
 * Time:    2:37 PM
 **/

/**
 * @param string $action    Controller@method
 * @param string $namespace No backslash at the beginning or end
 * @param array $args       key->value pairs or just simple array
 *
 * @return mixed
 */
function run_action($action, $namespace = null, $args = [])
{
    $request = request();
    $action = 'App\Http\Controllers' . ($namespace ? '\\' . $namespace . '\\' . $action : '\\' . $action);

    list($class) = explode('@', $action);
    $method = explode('@', $action)[1];

    $reflector = new ReflectionMethod($class, $method);

    $pass = [];
    foreach ($reflector->getParameters() as $param) {

        /* @var $param ReflectionParameter */
        if (isset($args[$param->getName()])) {
            $pass[] = $args[$param->getName()];
        } elseif ($param->getType() == get_class($request)) {
            $pass[] = $request;
        } else {
            $pass[] = $param->getDefaultValue();
        }
    }

    return $reflector->invokeArgs(new $class, $pass);
}

function redirectOnAuthSuccess()
{
    return url()->route('app.home');
}

/**
 * @param $data
 *
 * @return \Illuminate\Http\JsonResponse
 */
function to_json($data)
{
    if (is_json($data))
        return $data;

    return response()->json($data);
}
