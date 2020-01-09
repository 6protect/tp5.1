<?php

namespace app\index\model;

use think\Model;

class ticket extends Model
{
    //
    public $pk='id';
    public static function getTicketInfoList($tId){
        return self::where('id',$tId)->select();
    }
}
