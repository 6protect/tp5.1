<?php

namespace app\api\model;

use think\Model;

class Course extends Model
{
    //5.1中模型不会自动获取主键名称，必须设置pk属性。默认为'id'
    protected $pk = "id";


    //获得课程列表(4)
    public static function getCourseList(){
    	//按id降序排序
        return self::field('id,course_name,price')->order('id', 'desc')->limit(4)->select();
    }




}
