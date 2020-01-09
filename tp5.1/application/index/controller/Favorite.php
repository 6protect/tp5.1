<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use \app\index\model\favorite as FavoriteModel;
use \app\index\model\course as CourseModel;
use \app\index\model\orders as OrdersModel;
use \app\index\model\headline as HeadLineModel;
use \app\index\model\haderline_image as HeadLineImageModel;
class Favorite extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $userInfo=cache($this->request->param('token'));
        $userInfo['id']=1;
        $favoriteList=FavoriteModel::getFavorite($userInfo['id']);
        $courseList=array();
        $headLineList=array();
        foreach ($favoriteList as $key=>$value){

            if ($value['cid']!=''){
                $course=CourseModel::getCourse($value['cid']);
                $course[0]['count']=OrdersModel::getCourseCount($value['cid']);
                $courseList[$key]=$course;
            }
            if ($value['article_id']!=''){
                $headLine=HeadLineModel::getHeadLine($value['article_id']);
                $headLineImage=HeadLineImageModel::getHeadLIneimage($value['article_id']);
                $headLine[0]['img_dir']=$headLineImage[0]['img_dir'];
                $headLine[0]['image']=$headLineImage[0]['image'];
                $headLine[0]['islike']=$value['like'];
                $headLineList[$key]=$headLine;
            }

        }
        $data['courseList']=$courseList;
        $data['headLineList']=$headLineList;
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
