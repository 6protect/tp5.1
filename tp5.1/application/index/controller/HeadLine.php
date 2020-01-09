<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use \app\index\model\headline as HeadLineModel;
use \app\index\model\haderline_image as HeadLineImageModel;
use think\Validate;
use \app\index\model\favorite as FavoriteModel;
use \app\index\model\member as MemberModel;
class HeadLine extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        $userInfo=cache($this->request->param('token'));
        $userInfo=MemberModel::getUserINfo(1);
        $request_data = request()->param('');
        $validater = new Validate();
        $validater->rule([
            'article_id'=>'require'
        ]);
        $result= $validater->check($request_data);
        if(!$result){
            return json(['error_code'=>10001,'msg'=>$validater->getError()],402);
        }
        $articleId=$request_data['article_id'];
        $headLine=HeadLineModel::getHeadLIne($articleId);
        $headLineImage=HeadLineImageModel::getHeadLIneImage($articleId);
        if (count($headLine)==0){
            return json(['error_code'=>10002,'msg'=>'头条id不正确!请重新获取!'],403);
        }
        $favoriteInfo=FavoriteModel::getFavoriteInfo($userInfo[0]['id'],$articleId);

        $headLine[0]['img_dir']=$headLineImage[0]['img_dir'];
        $headLine[0]['image']=$headLineImage[0]['image'];
        $headLine[0]['islike']=$favoriteInfo[0]['like'];
        $data['userInfo']=$userInfo;
        $data['headLine']=$headLine;
        return json(['error_code'=>0,'data'=>$data],200);
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
    public function editFavorite()
    {
        //
        $userInfo=cache($this->request->param('token'));
        $userInfo['id']=1;
        $request_data = request()->param('');
        $validater = new Validate();
        $validater->rule([
            'article_id'=>'require',
            'type'=>'require',
            'status'=>'require'
        ]);
        $result= $validater->check($request_data);
        if(!$result){
            return json(['error_code'=>10001,'msg'=>$validater->getError()],402);
        }
        $articleId=(int)$request_data['article_id'];
        $headLine=HeadLineModel::getHeadLIne($articleId);
        if (count($headLine)==0){
            return json(['error_code'=>10002,'msg'=>'头条id不正确!请重新获取!'],403);
        }
        $userId=(int)$userInfo['id'];
        $type=$request_data['type'];
        if ($type!='like'&&$type!='collect'){
            return json(['error_code'=>10002,'msg'=>'type的值不正确!请传\'like\'或者\'collect\'!'],403);
        }
        $status=(int)$request_data['status'];
        if ($status!=0&&$status!=1){
            return json(['error_code'=>10002,'msg'=>'status的值不正确!请传\'0\'或者\'1\'!'],403);
        }
        if ($type=='like'){
            if ($status==0){
                FavoriteModel::addFavoriteLike($userId,$articleId);
                $res=HeadLineModel::incHeadLineLike($articleId);
                if($res){
                    return json(['error_code'=>0,'data'=>'点赞成功'],200);
                }

            }
            if ($status==1){
                FavoriteModel::delFavoriteLike($userId,$articleId);
                $res=HeadLineModel::decHeadLineLike($articleId);
                if($res){
                    return json(['error_code'=>0,'data'=>'取消点赞成功'],200);
                }

            }
        }
        if ($type=='collect'){
            if ($status==0){
                FavoriteModel::addFavorite($userId,$articleId);
                HeadLineModel::incHeadLineCollect($articleId);
                return json(['error_code'=>0,'data'=>'收藏成功'],200);
            }
            if ($status==1){
                FavoriteModel::delFavorite($userId,$articleId);
                HeadLineModel::decHeadLineCollect($articleId);
                return json(['error_code'=>0,'data'=>'取消收藏成功'],200);
            }
        }
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
