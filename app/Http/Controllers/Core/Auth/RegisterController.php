<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/10/2016
 * Time:    12:23 PM
 **/

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Auth\RegisterController as Base;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Validator;

class RegisterController extends Base
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
    public function showRegistrationForm()
    {
        $data = [];

        return view('auth.register', $data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'first_name' => 'required|max:255',
            //'last_name' => 'required|max:255',
            'email'    => 'required|email|max:190|unique:users',
            'phone'    => 'required|min:11|max:15|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new account instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User;
        //$user->first_name = $data['first_name'];
        //$user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = bcrypt($data['password']);
        $user->status = USER_STATUS_ACTIVE;
        $user->save();

        $role = Role::findByName(USER_ROLE_ACADEMIC);
        $user->roles()->attach($role);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $validator->validate();

        $data = [];
        if ($validator->passes()) {
            $user = $this->create($request->all());
            event(new Registered($user));
            $this->guard()->login($user);

            $data['user'] = $user;
            $data['message'] = Lang::get('auth.registration_ok');
            $data['status'] = true;
            $data['http_code'] = 201;
        }
        else {
            $data['message'] = Lang::get('auth.invalid_data');
            $data['status'] = false;
            $data['http_code'] = 401;
            $data['errors'] = $validator->errors();
        }

        if ($request->wantsJson()) {
            $data['redirect'] = $this->redirectPath();

            return to_json($data)->setStatusCode($data['http_code']);
        }
        else {
            foreach ($data as $key => $value) {
                $request->session()->push($key, $value);
            }

            return redirect($this->redirectPath());
        }
    }
}
