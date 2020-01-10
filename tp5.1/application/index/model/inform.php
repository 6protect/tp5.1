<?php

namespace app\index\model;

use think\Model;

class inform extends Model
{
    //
    public $pk='id';
    public static function getInformList($userId){
        return self::where('mid',$userId)->select();
    }
    public static function getInformcount($userId){
        return self::where('mid',$userId)->count();
    }
}
