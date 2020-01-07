<?php

namespace app\index\model;

use think\Model;

class haderline_image extends Model
{
    //
    public $pk='id';
    public static function getHeadLineImage($headlineId){
        return self::where('hid',$headlineId)->select();
    }
}
