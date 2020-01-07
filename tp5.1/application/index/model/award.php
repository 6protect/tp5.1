<?php

namespace app\index\model;

use think\Model;

class award extends Model
{
    //
    public $pk='id';
    public static function getAward($userId){
        return self::where('mid',$userId)->select();
    }
    public static function getAwardCount($userId){
        return self::where('mid',$userId)->count();
    }
}
