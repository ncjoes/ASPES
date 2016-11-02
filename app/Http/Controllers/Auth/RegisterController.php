<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Validator;

class RegisterController extends Controller
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
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $validator->validate();

        $data = [];
        $user = $this->create($request->all());
        event(new Registered($user));
        $this->guard()->login($user);

        $data['message'] = Lang::get('auth.registration_ok');
        $data['status'] = true;
        $data['data']['user'] = $user;

        if ($request->wantsJson()) {
            $data['data']['redirect'] = $this->redirectPath();

            return response()->json($data)->setStatusCode(201);
        }

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $role = Role::findByName(User::ROLE_ACADEMIA);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'slug'       => User::makeSlug($data['first_name'].' '.$data['last_name']),
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'password'   => bcrypt($data['password']),
        ]);
        $user->roles()->attach($role);

        return $user;
    }

    public function redirectPath()
    {
        return url()->route('app.home');
    }
}
