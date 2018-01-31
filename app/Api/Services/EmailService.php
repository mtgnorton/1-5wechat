<?php

namespace App\Api\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class EmailService
{
    public static function verify($token)
    {

        $user = User::where('confirmation_token',$token)->first();

        if (is_null($user)) {
            return redirect('/login');
        }
        $user->update(['is_active'=>1,'confirmation_token'=>str_random(40)]);

        Auth::login($user);

        return redirect('/home');
    }

    public static function forget(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if (is_null($user)) {
            Rerror('邮箱不存在');
            return back()->withInput();
        }

    }

    public function test($value='')
    {
        Rsuccess('1212');
        return redirect('home');
    }
}
