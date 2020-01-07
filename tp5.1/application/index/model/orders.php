<?php

namespace app\index\model;

use think\Model;

class orders extends Model
{
    //
    public $pk='id';
    public static function getCourseCount($courseId){
        return self::where('cid',$courseId)->count();
    }
}
