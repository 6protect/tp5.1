<?php

namespace app\index\model;

use think\Model;

class member extends Model
{
    //
    public $pk='id';
    public static function getUserINfo($userId){
        return self::where('id',$userId)->select();
    }
}
