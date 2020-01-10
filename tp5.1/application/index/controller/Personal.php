<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use \app\index\model\myTicket as TicketModel;
use app\index\model\member as MemberModel;
use app\index\model\favorite as FavoriteModel;
use app\index\model\orders as OrdersModel;
use app\index\model\inform as InformModel;
class Personal extends Controller
{
    /**
     * 显示用户信息
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $userInfo=cache($this->request->param('token'));
        $ticketCount=TicketModel::getTicketCount($userInfo[0]['id']);
        $favoriteCount=FavoriteModel::getFavoriteCount($userInfo[0]['id']);
        $courseCount=OrdersModel::getCourseCount($userInfo[0]['id']);
        $informCount=InformModel::getInformcount($userInfo[0]['id']);
        $data['userInfo']=$userInfo;
        $data['ticketCount']=$ticketCount;
        $data['favoriteCount']=$favoriteCount;
        $data['courseCount']=$courseCount;
        $data['informCount']=$informCount;
        return json(['error_code'=>0,'data'=>$data],200);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
