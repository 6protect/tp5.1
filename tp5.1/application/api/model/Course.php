<?php

namespace app\api\model;

use think\Model;

class Course extends Model
{
    //5.1��ģ�Ͳ����Զ���ȡ�������ƣ���������pk���ԡ�Ĭ��Ϊ'id'
    protected $pk = "id";


    //��ÿγ��б�(4)
    public static function getCourseList(){
    	//��id��������
        return self::field('id,course_name,price')->order('id', 'desc')->limit(4)->select();
    }




}
