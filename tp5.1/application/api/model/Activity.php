<?php

namespace app\api\model;

use think\Model;

class Activity extends Model
{
    //
    public static function getActivity(){

    }
//������Ż�б�(4)
    public static function getActivityList(){
    	//��id��������
        return self::field('id,title,num')->order('id', 'desc')->limit(4)->select();
    }
}
