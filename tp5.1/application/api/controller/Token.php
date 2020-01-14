<?php
namespace app\api\controller;

use think\Controller;
use app\api\model\Member as MemberModel;
use think\Validate;

class Token extends Controller
{
    public function getToken()
    {

        //声明CODE，获取小程序传过来的CODE
        $code = $_GET["code"];

        //配置appid
        $appid = "wxed0433eb6a508230";
        //配置appscret
        $secret = "45da425df3654b58a20d9615c58b50b8";
        //api接口
        $api = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";

        //获得openid
        $str = self::httpGet($api);
//        file_put_contents("a.txt",$str);

        $str_arr = json_decode($str,true);
        $openid = $str_arr['openid'];
        var_dump($str_arr);
        // 生成token返回, 足够随机, 不重复
        $token = md5(uniqid(time()));


//    	//获得所传参数
//    	$request_data = request()->param('');
//    	// 参数过滤
//        $validater = new Validate();
//        $validater->rule([
//            'username'=>'require',
//            'password'=>'require'
//        ]);
//        $result= $validater->check($request_data);
//        if(!$result){
//            return json(['error_code'=>10001,'msg'=>$validater->getError()],402);
//        }
//    	//获得用户信息
//    	$user_info = MemberModel::getUserInfo($request_data);
//    	if($user_info){
//            // 生成token返回, 足够随机, 不重复
//            $token = md5(uniqid(time()));
//            // 保存token
//            cache($token, $user_info, 7200);
//            // 返回token
//            return json(['error_code' => 0, 'data' => ['token' => $token]], 200);
//        }else{
//            return json(['error_code' => 10004, 'msg' => '用户名或密码不正确'], 401);
//        }
    }

    //获取GET请求
    public static function httpGet($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_NOBODY,0);
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }


}