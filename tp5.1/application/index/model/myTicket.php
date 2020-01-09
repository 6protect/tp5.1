<?php

namespace app\index\model;

use think\Model;

class myTicket extends Model
{
    //
    public $pk='id';
    public static function getTicket($userId){
        return self::where('mid',$userId)->select();
    }
    public static function getTicketCount($userId){
        return self::where('mid',$userId)->count();
    }
}
