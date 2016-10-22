<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/10/2016
 * Time:    12:26 PM
 **/

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Auth\ResetPasswordController as Base;
use Illuminate\Http\Request;

class ResetPasswordController extends Base
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->redirect = request()->has('redirect') ? request()->input('redirect') : redirectOnAuthSuccess();
    }

    /**
     * @inheritDoc
     */
    public function showResetForm(Request $request, $token = null)
    {
        $data = ['token' => $token, 'email' => $request->email];

        return view('auth.passwords.reset', $data);
    }

    /**
     * @inheritDoc
     */
    protected function sendResetResponse($response)
    {
        if (request()->wantsJson()) {
            return to_json(['status' => true, 'message' => trans($response)]);
        }

        return parent::sendResetResponse($response);
    }

    /**
     * @inheritDoc
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return to_json(['status' => false, 'message' => trans($response)]);
        }

        return parent::sendResetFailedResponse($request, $response);
    }
}
