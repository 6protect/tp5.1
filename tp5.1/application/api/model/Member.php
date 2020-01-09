<?php

namespace app\api\model;

use think\Model;

class Member extends Model
{
    //更换手机号
    public static function changePhone($phone,$id){
        $user = Member::get($id);
        $user->mobile  = $phone;
        $res = $user->save();
        return $res;
    }

}
