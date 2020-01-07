<?php

namespace app\index\model;

use think\Model;

class ticket extends Model
{
    //
    public $pk='id';
    public static function getTicket($userINfo){
        return self::where('mid',$userINfo['id'])->select();
    }
    public static function getTicketCount($userINfo){
        return self::where('mid',$userINfo['id'])->count();
    }
}
