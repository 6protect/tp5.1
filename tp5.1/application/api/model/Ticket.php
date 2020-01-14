<?php

namespace app\api\model;

use think\Model;

class Ticket extends Model
{
    //5.1中模型不会自动获取主键名称，必须设置pk属性。默认为'id'
    protected $pk = "id";

    public function award()
    {
        return $this->hasMany('Award','ticket_type');
    }

    //邀请新用户得优惠券
    public static function getTicket($data){
        $id = Award::where('get_method','邀请朋友')->field('id')->find();
return $id;
//        return self::create([
//            'mid' => $data,
//            'ticket_type' => $id
//            ]);
    }
}
