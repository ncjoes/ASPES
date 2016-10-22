<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/10/2016
 * Time:    12:00 PM
 **/

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Auth\LoginController as Base;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Base
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * LoginController constructor.
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
    public function showLoginForm()
    {
        $data = [];

        return view('auth.login', $data);
    }

    /**
     * Override default behaviors on login failure/success
     */
    /**
     * Send the response after the account was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    /**
     * The account has been authenticated.
     * Check for additional access requirements
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $data = [];
        if ($user->status == USER_STATUS_ACTIVE) {
            $data['status'] = true;
            $data['message'] = 'login_ok';
        }
        else {
            // Log the account out.
            $this->logout($request);

            $data['message'] = Lang::get('auth.blocked');
            $data['status'] = false;
        }

        if ($request->wantsJson()) {
            $data['redirect'] = $this->redirectPath();

            return to_json($data);
        }
        else {
            foreach ($data as $key => $value) {
                $request->session()->flash($key, $value);
            }

            return redirect()->intended($this->redirectPath());
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $data['status'] = false;
        $data['message'] = Lang::get('auth.failed');

        if ($request->wantsJson()) {
            return to_json($data);
        }
        else {
            return redirect()->back()
                             ->withInput($request->only($this->username(), 'remember'))
                             ->withErrors([
                                 $this->username() => $data['message'],
                             ]);
        }
    }
}
