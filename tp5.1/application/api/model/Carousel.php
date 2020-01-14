<?php
namespace app\api\model;

use think\Model;

class Carousel extends Model
{
    //5.1中模型不会自动获取主键名称，必须设置pk属性。默认为'id'
    protected $pk = "id";


    //获得轮播图(4)
    public static function getCarousel(){
        //按rank值大小降序排序
        return self::where('status',0)->where('flag',0)->order('rank', 'desc')->field('id,link')->limit(4)->select();
    }




}
