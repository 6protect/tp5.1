<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Orders as OrdersModel;
use app\api\model\Member as MemberModel;

class Orders extends Controller
{
    protected $middleware = [

        'check'

    ];
    /**
     * ░░░░░░░░░░░░░░░░░░░░░░░░▄░░
     * ░░░░░░░░░▐█░░░░░░░░░░░▄▀▒▌░
     * ░░░░░░░░▐▀▒█░░░░░░░░▄▀▒▒▒▐
     * ░░░░░░░▐▄▀▒▒▀▀▀▀▄▄▄▀▒▒▒▒▒▐
     * ░░░░░▄▄▀▒░▒▒▒▒▒▒▒▒▒█▒▒▄█▒▐
     * ░░░▄▀▒▒▒░░░▒▒▒░░░▒▒▒▀██▀▒▌
     * ░░▐▒▒▒▄▄▒▒▒▒░░░▒▒▒▒▒▒▒▀▄▒▒
     * ░░▌░░▌█▀▒▒▒▒▒▄▀█▄▒▒▒▒▒▒▒█▒▐
     * ░▐░░░▒▒▒▒▒▒▒▒▌██▀▒▒░░░▒▒▒▀▄
     * ░▌░▒▄██▄▒▒▒▒▒▒▒▒▒░░░░░░▒▒▒▒
     * ▀▒▀▐▄█▄█▌▄░▀▒▒░░░░░░░░░░▒▒▒
     * 单身狗就这样默默地看着你，一句话也不说。
     */
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    //获取全部订单
    public function getAllOrder()
    {
        //
        $user_info = cache($this->request->param('token'));
        $id = $user_info['id'];
        $data = OrdersModel::getAllOrder($id);
        //返回json
        return json(['error_code'=>0,'data'=>$data],200);
    }
    //获取待付款的订单
    public function getObligationOrder(){
        $user_info = cache($this->request->param('token'));
        $id = $user_info['id'];
        $data = OrdersModel::getObligationOrder($id);
        //返回json
        return json(['error_code'=>0,'data'=>$data],200);
    }
    //获取学习中的订单
    public function getStudyingOrder(){
        $user_info = cache($this->request->param('token'));
        $id = $user_info['id'];
        $data = OrdersModel::getStudyingOrder($id);
        //返回json
        return json(['error_code'=>0,'data'=>$data],200);
    }
    //获取学习结束的订单
    public function getEndOrder(){
        $user_info = cache($this->request->param('token'));
        $id = $user_info['id'];
        $data = OrdersModel::getEndOrder($id);
        //返回json
        return json(['error_code'=>0,'data'=>$data],200);
    }

}
