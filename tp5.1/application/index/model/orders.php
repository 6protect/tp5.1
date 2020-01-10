<?php

namespace app\index\model;

use think\Db;
use think\Model;

class orders extends Model
{
    //
    public $pk='id';
    public static function getCourseCount($userId){
        return Db::table('three_orders')
            ->field('status,COUNT(id) as count')
            ->where('mid',$userId)
            ->group('status')
            ->select();
    }
}
