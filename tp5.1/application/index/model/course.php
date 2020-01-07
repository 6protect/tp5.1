<?php

namespace app\index\model;

use think\Model;

class course extends Model
{
    //
    public $pk='id';
    public static function getCourse($courseId){
        return self::where('id',$courseId)->select();
    }
}
