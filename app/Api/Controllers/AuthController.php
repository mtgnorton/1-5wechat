<?php

namespace App\Api\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Api\Services\EmailService;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends Controller
{
    use RegistersUsers;
//    use AuthenticatesUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $user =  User::create([

            'name'               => $data['name'],
            'email'              => $data['email'],
            'avatar'             => '/images/avatars/default.jpg',
            'confirmation_token' => str_random(40),
            'password'           => bcrypt($data['password']),

        ]);

        return $user;
    }


    /**
     * author: mtg
     * function description:用户注册后,邮箱激活
     * @param Request $request
     */
    public function emailVerify(Request $request){

            EmailService::verify($request->token);
    }


    /**
     * author: mtg
     * function description:用户登陆
     * @param Request $request
     * @return bool
     */
    protected function login(Request $request)
    {
        $validate = array_merge($request->only($this->username(), 'password'),['is_active'=>1]);

        $result =$this->guard()->attempt(
            $validate,$request->has('remember')
        );

        return rsSuccess($result);
    }

    /**
     * author: mtg
     * function description:登陆验证的字段
     * @return string
     */
    public function username(){
        return 'name';
    }
}

