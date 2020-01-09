<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Member as MemberModel;
use think\facade\Session;

class ChangeNumber extends Controller
{
    protected $middleware = [

        'check'

    ];
    /**
     *      ┌─┐       ┌─┐ + +
     *   ┌──┘ ┴───────┘ ┴──┐++
     *   │                 │
     *   │       ───       │++ + + +
     *   ███████───███████ │+
     *   │                 │+
     *   │       ─┴─       │
     *   │                 │
     *   └───┐         ┌───┘
     *       │         │
     *       │         │   + +
     *       │         │
     *       │         └──────────────┐
     *       │                        │
     *       │                        ├─┐
     *       │                        ┌─┘
     *       │                        │
     *       └─┐  ┐  ┌───────┬──┐  ┌──┘  + + + +
     *         │ ─┤ ─┤       │ ─┤ ─┤
     *         └──┴──┘       └──┴──┘  + + + +
     *                神兽保佑
     *               代码无BUG!
     */
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $user_info = cache($this->request->param('token'));

        $info_data = MemberModel::get($user_info['id']);

       $data = $info_data['mobile'];
        return json(['error_code'=>0,'data'=>$data],200);

    }
    public function juhecurl($url,$params=false,$ispost=0){

        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
    //通过用户手机号发送验证码
    public function byUserPhoneSendCode(){
        $user_info = cache($this->request->param('token'));
        $phone = $user_info['mobile'];
        $data = $this->sendCode($phone);
        return json(['error_code'=>0,'data'=>$data],200);
    }
    //通过用户输入的手机号发送验证码
    public function byUserInputPhoneSendCode(){
        cache($this->request->param('token'));
        $phone = $this->request->param('phone');
        Session::set('inputPhone',$phone);
        $data = $this->sendCode($phone);
        return json(['error_code'=>0,'data'=>$data],200);
    }
    public function sendCode($phone){
        $code = mt_rand(100000,999999);
        $url = "http://v.juhe.cn/sms/send";
        $params=array(
            'key'   => '70ffa1eff9a69f5847bc5450ff994fdd', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '192550', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>"#code#=" . $code . "&#company#=聚合数据" //您设置的模板变量，根据实际情况修改
        );
        $paramstring=http_build_query($params);
        $content=$this->juhecurl($url,$paramstring);

        $result = json_decode($content, true);
        if ($result) {
            if(!$result['error_code']){
                // 短信发送成功
                Session::set('code',$code);
                Session::set('timeout',time()+60);
                $data['status']=1;

            }else{
                $data['status']=0;
            }
        } else {
            //请求异常
            $data['status']=3;
        }
        return $data;

    }
    //验证用户手机号发送过来的验证码
    public function verifyUserPhoneSendCode(){
       cache($this->request->param('token'));
       $data = $this->verifyCode();
        return json(['error_code'=>0,'data'=>$data],200);
    }
    //验证用户输入的手机号发送过来的验证码
    public function verifyUserInputPhoneSendCode(){
        $user_info = cache($this->request->param('token'));
        $id = $user_info['id'];
        $phone = Session::get('inputPhone');
        $data = $this->verifyCode();
        if ($data['status'] == 1){
            $row = MemberModel::changePhone($phone,$id);
            if ($row == 1){
                $data['status'] = 3;
            }else{
                $data['status'] = 4;
            }

        }else{

        }
        return json(['error_code'=>0,'data'=>$data],200);

    }
    //验证验证码
    public function verifyCode(){
        //获取用户输入的验证码
        $ucode = $this->request->param('code');
        //获取存进session的验证码
        $scode = Session::get('code');
        if ($ucode == $scode){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        Session::delete('code');
        return $data;
    }


}
