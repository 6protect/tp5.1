<?php

namespace app\api\model;

use think\Model;

class MyEvents extends Model
{
    protected $pk = "my_events_id";
    //
    public static function getMyEvents($user_info){
        return self::with('Activity')->where('uid', $user_info['id'])->select();
    }
    public static function getMyEventsDetails($user_info){
        return self::with(['Activity','MyActivity'])->where('id', $user_info['eid'])->select();
    }
    public  function Activity(){
        return $this->hasOne('Activity','id','eid');

    }

    public  function MyActivity(){
        return $this->hasOne('Member','id','uid');

    }
}
