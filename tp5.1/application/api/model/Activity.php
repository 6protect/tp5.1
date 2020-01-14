<?php

namespace app\api\model;

use think\Model;

class Activity extends Model
{
    //
    public static function getActivity(){

    }
//获得热门活动列表(4)
    public static function getActivityList(){
    	//按id降序排序
        return self::field('id,title,num')->order('id', 'desc')->limit(4)->select();
    }
}
