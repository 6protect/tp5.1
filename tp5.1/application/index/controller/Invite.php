<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\award as AwardModel;
class Invite extends Controller
{
    /**
     * 显示邀请码
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $userInfo=cache($this->request->param('token'));
        $awardList=AwardModel::getAward($userInfo[0]['id']);
        $awardListCount['count']=AwardModel::getAwardCount($userInfo[0]['id']);
        $data['userInfo']=$userInfo;
        $data['awardListCount']=$awardListCount;
        $data['awardList']=$awardList;
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
