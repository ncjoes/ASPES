<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/10/2016
 * Time:    11:42 AM
 **/

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController as Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Base
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * @inheritDoc
     */
    public function sendResetLinkEmail(Request $request)
    {
        if ($request->wantsJson()) {
            $this->validate($request, ['email' => 'required|email']);

            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            if ($response === Password::RESET_LINK_SENT) {
                return to_json(['status' => true, 'message' => trans($response)]);
            }

            return to_json(['status' => false, 'message' => trans($response)]);
        }

        return parent::sendResetLinkEmail($request);
    }
}