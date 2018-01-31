<?php
namespace App\Api\Listeners;
use Illuminate\Auth\Events\Registered;
use Log;
use Cache;
use DB;
use Naux\Mail\SendCloudTemplate;

class RegisteredUser
{
    public function __construct()
    {
        //
    }

    public function handle(Registered $event)
    {
      $this->sendEmail($event->user);

    }

    //todo 改为异步发送
    public function sendEmail($user){

        $sendData = [
            'url'  => url('api/email/verify/'.$user->confirmation_token),
            'name' =>$user->name
        ];

        $template = new SendCloudTemplate('zhihu_app_register', $sendData);

        \Mail::raw($template, function ($message) use ($user) {
            $message->from('mtg@mtg.com', 'mtg');
            $message->to($user->email);
        });

    }

    //todo 增加日志
    public function log($user){
        Log::info('任务添加成功',['id'=>$user->id,'title'=>$user->name]);
        echo $user->name;
        Cache::put('name',$user->name,10);
        $name = "mtg";
        Cache::get('ss',function() use ($name) {
            return DB::table('users')->where('name',$name)->value('email');
        } );
    }
}