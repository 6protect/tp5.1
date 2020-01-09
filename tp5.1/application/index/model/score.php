<?php

namespace app\index\model;

use think\Model;

class score extends Model
{
    //
    public $pk='id';
    public static function getScoreList($userId){
        return self::where('mid',$userId)->select();
    }
}
