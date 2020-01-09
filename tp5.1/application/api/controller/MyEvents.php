<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\MyEvents as MyEventsModel;
use app\api\model\Activity as ActivityModel;
use app\api\model\Member as MemberModel;

class MyEvents extends Controller
{

    protected $middleware = [

        'check'

    ];
    /**
     * http://www.flvcd.com/
     *  .--,       .--,
     * ( (  \.---./  ) )
     *  '.__/o   o\__.'
     *     {=  ^  =}
     *      >  -  <
     *     /       \
     *    //       \\
     *   //|   .   |\\
     *   "'\       /'"_.-~^`'-.
     *      \  _  /--'         `
     *    ___)( )(___
     *   (((__) (__)))    高山仰止,景行行止.虽不能至,心向往之。
     */
    /**
     * 显示资源列表
     *
     * @return \think\getMyEvents
     */
    //我的活动列表
    public  function getMyEvents()
    {

        $user_info = cache($this->request->param('token'));
        $user_info['id'] = 1;
        //请求数据库查数据
        $data = MyEventsModel::getMyEvents($user_info);
        //返回json
        return json(['error_code'=>0,'data'=>$data],200);
    }
    //个人活动详情
    public function myEventsDetails(){
        $user_info = cache($this->request->param('token'));
        $user_info['eid'] = $this->request->param('id');
        //请求数据库查数据
        $data = MyEventsModel::getMyEventsDetails($user_info);
        //返回json
        return json(['error_code'=>0,'data'=>$data],200);
    }


}
