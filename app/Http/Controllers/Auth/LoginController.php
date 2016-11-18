<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->back();
    }

    public function redirectPath()
    {
        return url()->route('app.home');
    }

    protected function sendLoginResponse(Request $request)
    {
        if ($request->wantsJson()) {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            return $this->authenticated($request, $this->guard()->user())
                ?: ['status'=>true, 'message'=>'Login Successful. Redirecting...', 'data'=>['redirect' => $this->redirectPath()]];
        }

        return parent::callAction('sendLoginResponse', [$request]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->wantsJson()) {
            $data['status'] = false;
            $data['message'] = Lang::get('auth.failed');

            return $data;
        }

        return parent::callAction('sendFailedLoginResponse', [$request]);
    }
}
