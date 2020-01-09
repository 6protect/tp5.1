<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use \app\index\model\myTicket as MyTicketModel;
use think\Validate;
use app\index\model\ticket as TicketModel;

class ticket extends Controller
{
    /**
     * 显示优惠券列表
     *
     * @return \think\Response
     */
    public function getTicket()
    {
        $userInfo=cache($this->request->param('token'));
        $ticketList=MyTicketModel::getTicket($userInfo[0]['id']);
        $ticketInfoList=array();
        foreach ($ticketList as $key => $value){
            $ticketInfoList[$key]=TicketModel::getTicketInfoList($value['tid']);
            $ticketInfoList[$key][0]['send_time']=$value['add_time'];
        }
        $data['userInfo']=$userInfo;
        $data['ticketInfoList']=$ticketInfoList;
        return json(['error_code'=>0,'data'=>$data],200);
    }

}
