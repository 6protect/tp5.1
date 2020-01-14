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
    
    //查询手机号是否已被注册
    public static function inquireMobile($data){
        return self::where('mobile',$data)->find();
    }

    //注册新用户
    public static function register($data){
        return self::create([
            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'sex' => $data['sex'],
            'avatar' => $data['avatar'],
            'invite_code' => $data['invite_code'],
        ]);
    }

    //查询邀请码是否存在
    public static function ticket($data){
        return self::where('invite_code',$data)->field('id')->find();
    }



    //获取用户信息
    public static function getUserInfo($data) {

        return self::where('user_name',$data['username'])->find();
    }
}
