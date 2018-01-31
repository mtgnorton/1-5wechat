<?php
namespace App\Api\Listeners;
use Illuminate\Auth\Events\Login;
use Log;
use Cache;
use DB;
use App\Models\LoginLog;
class LoginSuccessful
{
    public function __construct()
    {
        //
    }

    public function handle(Login $event)
    {
        $this->log($event->user);

    }

    //todo 增加日志
    public function log($user){
        LoginLog::create(
            [
                'user_id'=>$user->id,
                'ip'=>request()->getClientIp()
            ]
        );

    }
}