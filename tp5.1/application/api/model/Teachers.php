<?php
namespace app\api\model;

use think\Model;

class Teachers extends Model
{
    //5.1中模型不会自动获取主键名称，必须设置pk属性。默认为'id'
    protected $pk = "id";


    //获得明星教师信息(3位)
    public static function getTeacherList(){
    	//按照教龄降序排序
        return self::where('active',1)->field('id,username,avatar,adept')->order('seniority', 'desc')->limit(3)->select();
    }




}
