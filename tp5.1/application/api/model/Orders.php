<?php

namespace app\api\model;

use think\Model;

class Orders extends Model
{
    protected $pk = "orders_id";
    //
    //获取全部订单
    public static function getAllOrder($id){
        return self::with('course')->where('mid',$id)->order(['add_time desc','status desc'])->select();
    }
    //获取待付款的订单
    public static function getObligationOrder($id){
        $data['mid'] = $id;
        $data['status'] = 1;
        return self::with('course')->where($data)->order('add_time desc')->select();
    }
    //获取学习中的订单
    public static function getStudyingOrder($id){
        $data['mid'] = $id;
        $data['status'] = 2;
        return self::with('course')->where($data)->order('add_time desc')->select();
    }
    //获取已结束的订单
    public static function getEndOrder($id){
        $data['mid'] = $id;
        $data['status'] = 3;
        return self::with('course')->where($data)->order('add_time desc')->select();
    }
    public function member(){
        return $this->hasOne('Member','id','mid');
    }
    public function course(){
        return$this->hasMany('Course','id','cid');
    }
}
