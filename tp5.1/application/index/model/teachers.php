<?php

namespace app\index\model;

use think\Model;

class teachers extends Model
{
    //
    public $pk='id';
    public static function getTeachers(){
        return self::select();
    }
}
