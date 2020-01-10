<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/3
 * Time: 15:38
 */

namespace app\home\controller;

use think\Db;
use think\Request;

class EducationHead
{

    /*
     * 进入教育头条页面
     */
    public function headList(Request $request)
    {
        $row = Db::name('headline')->select();
        if (!$row) {
            $data = jsonData( 10002,'没有资源', $row);
        } else {
            $data = jsonData(0,'获取数据成功', $row);
        }
        return json($data,201);
    }

    /*
     * 教育头条查询
     */
    public function headSeach(Request $request)
    {
        $key = $request->param('key');
        if ($key){
            $where[] = ['title', 'like', '%' . $key . '%'];
            $row = Db::name('headline')->where($where)->select();
            if (!$row) {
                $data = jsonData(10004,'没有资源', $row);
            } else {
                $data = jsonData(0,'获取数据成功', $row);
            }
        }else{
            $data = jsonData(10005,'未传值');
        }
        return json($data,201);
    }

    /*
     * 进入教育头条详情页
     */
    public function headDateils(Request $request)
    {
        // 文章id
        $id = $request->param('id');
        if ($id){
            $where['id'] = $id;
            $row = Db::name('headline')->where($where)->select();
            if (!$row) {
                $data = jsonData(10004,'没有资源', $row);
            } else {
                $data = jsonData(0,'获取数据成功', $row);
            }
        }else{
            $data = jsonData(10005,'未传值', []);
        }
        return json($data,201);
    }

    /*
     * 点赞与点赞功能
     */
    public function like(Request $request)
    {
        // 文章id
        $id = $request->param('id');
        $flag = $request->param('flag');
        $token = $request->param('token');
        if ($id && $flag) {
            if($flag == 1){
                // 收藏
                $name = 'collect';
                $str = '收藏';
            }else{
                //点赞
                $name = 'like';
                $str = '点赞';
            }
            // 用户id
            $user_info = cache($token);
            $mid = $user_info['id'];
            $where['article_id'] = $id;
            $where['mid'] = $mid;
            $row = Db::name('favorite')->where($where)->find();
            if ($row) {
                if ($row[$name] == 1) {
                    // 改为收藏
                    $res = Db::name('favorite')->where($where)->update([$name => '0']);
                    $msg = "已".$str;
                    $sta = 1;
                } else {
                    // 改为为收藏
                    $res = Db::name('favorite')->where($where)->update([$name => '1']);
                    $msg = "已取消".$str;
                    $sta = 0;
                }
            } else {
                // 插入数据
                $data = [$name => '0', 'mid' => $mid, 'article_id' => $id, 'add_time' => time()];
                $res = Db::name('favorite')->insert($data);
                $msg = "已".$str;
                $sta = 1;
            }
            $val = $name.'_num';
            $num = Db::name('headline')->where(['id'=>$id])->value($val);
            if ($sta == 1){
                $num = $num+1;
            }else{
                $num = $num-1;
            }
            Db::name('headline')->where(['id'=>$id])->update([$val=>$num]);
            if ($res){
                $da = jsonData(0,$msg);
            }else{
                $da = jsonData(10003,'系统繁忙,请稍后');
            }
        } else {
            // 文章id未传值
            $da = jsonData(10005,'未传值');
        }
        return json($da,201);
    }
}
