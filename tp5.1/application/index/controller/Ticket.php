<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use \app\index\model\ticket as TicketModel;
use think\Validate;

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
        $ticket_data=TicketModel::getTicket($userInfo);
        return json(['error_code'=>0,'data'=>$ticket_data],200);
    }

}
