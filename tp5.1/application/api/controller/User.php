<?php
namespace app\api\controller;

use think\Controller;
//自定义类
use lib\serverApi;
//会员表模型
use app\api\model\Member as MemberModel;
//优惠券表模型
use app\api\model\Ticket as TicketModel;
use think\Validate;
use think\Request;

class User extends Controller
{
    //注册
    public function register()
    {
        //所有数据
        $request_data = request()->param('');

        // 参数过滤
        $validater = new Validate();
        $validater->rule([
            'mobile'=>'require|mobile',
            'username'=>'require',
            'verify_code'=>'require',
            'sex'=>'require',
            'avatar'=>'require'
        ]);
        $result= $validater->check($request_data);
        if(!$result){
            return json(['error_code'=>10001,'msg'=>$validater->getError()],406);
        }

        //手机号
        $mobile = $request_data['mobile'];
        //用户名
        $username = $request_data['username'];
        //性别
        $sex = $request_data['sex'];
        //头像地址
        $avatar = $request_data['avatar'];
        //验证码
        $verify_code = $request_data['verify_code'];
        //邀请人邀请码
        $invite_code = isset($request_data['invite_code'])?$request_data['invite_code']:[];

        //查询手机号是否已注册
        $bool = MemberModel::inquireMobile($mobile);
        if (!$bool){
            //检测验证码是否正确
            cache('code','123',60000);
            if (cache('code') == $verify_code){
                //检测邀请码是否存在,存在返回该邀请码所属会员id
                if ($invite_code){
                    $member_id = MemberModel::ticket($invite_code);
                    if (!isset($member_id)){
                        return json(['error_code'=>10004,'data'=>"邀请码不存在"],406);
                    }
                }
                //注册新用户
                $data['mobile'] = $mobile;
                $data['username'] = $username;
                $data['sex'] = $sex;
                $data['avatar'] = $avatar;
                $data['invite_code'] = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 8);
                $bool = MemberModel::register($data);
                //注册成功
                if ($bool){
                    //邀请者获得优惠券
                    if (isset($member_id)){
                        $d = TicketModel::getTicket($member_id['id']);
                        dump($d);
                    }
                    return json(['error_code'=>0,'data'=>"注册成功"],201);
                }else{
                    return json(['error_code'=>10000,'data'=>"注册失败"],406);
                }
            }else{
                return json(['error_code'=>10004,'data'=>"验证码错误"],406);
            }
        }else{
            return json(['error_code'=>10004,'data'=>"该手机号已被注册"],406);
        }

    }


    //获得验证码
    public function verifyCode()
    {
        //手机号
        $mobile = $_POST['mobile'];

        //网易云信分配的账号，请替换你在管理后台应用下申请的Appkey
        $AppKey = '97597263da0219c149b4c3d616e5993d';
        //网易云信分配的账号，请替换你在管理后台应用下申请的appSecret
        $AppSecret = 'f98f4a2ee352';
        $p = new ServerAPI($AppKey,$AppSecret,'fsockopen');     //fsockopen伪造请求

        //发送短信验证码
        $code = $p->sendSmsCode('14826781',$mobile,'','6');

        if ($code['code'] == 200){
            //存储缓存
            cache('code',$code['obj'],600);
            return json(['error_code'=>0,'data'=>$code['obj']],200);
        }else{
            return json(['error_code'=>10001,'data'=>"资源未找到"],404);
        }

    }


    //登录
    public function login(Request $request)
    {
        //声明CODE，获取小程序传过来的CODE
        $code = isset($_GET["code"])?$_GET["code"]:[];
        $username = isset($_GET['username'])?$_GET['username']:[];
        //配置appid
        $appid = "wxed0433eb6a508230";
        //配置appscret
        $secret = "45da425df3654b58a20d9615c58b50b8";
        //api接口
        $api = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";

        //发送
        $str = self::httpGet($api);
//        file_put_contents("a.txt",$str);

        //反串行化,转数组
        $str = json_decode($str,true);

        // 生成token返回, 足够随机, 不重复
        $token = md5(uniqid(time()));

        if ($username){
            $user_info = MemberModel::getUserInfo($username);
            $un = $user_info;
        }else{
            $un['username'] = $username;
        }
        // 保存token
        cache($token,$un, 7200);

        $data['str'] = $str;
        $data['token'] = $token;

        if (!$code){
            return json(['error_code'=>10002,'data'=>'未获取code'],401);
        }
        if (!$username){
            return json(['error_code'=>10002,'data'=>'未获取username'],401);
        }
        return json(['error_code'=>0,'data'=>$data],200);
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

