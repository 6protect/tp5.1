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
     * 收藏功能
     */
    public function collect(Request $request)
    {
        // 文章id
        $id = $request->param('id');
        $token = $request->param('token');
        if ($id) {
            // 用户id
            $user_info = cache($token);
            $mid = $user_info['id'];
            $where['article_id'] = $id;
            $where['mid'] = $mid;
            $row = Db::name('collect')->where($where)->find();
            if ($row) {
                if ($row['collect'] == 1) {
                    // 改为收藏
                    $res = Db::name('collect')->where($where)->update(['collect' => '0']);
                    $msg = "已收藏";
                    $sta = 1;
                } else {
                    // 改为为收藏
                    $res = Db::name('collect')->where($where)->update(['collect' => '1']);
                    $msg = "已取消收藏";
                    $sta = 0;
                }
            } else {
                // 插入数据
                $data = ['collect' => '0', 'mid' => $mid, 'article_id' => $id, 'add_time' => time()];
                $res = Db::name('collect')->insert($data);
                $msg = "已收藏";
                $sta = 1;
            }
            $collect_num = Db::name('headline')->where(['id'=>$id])->value('collect_num');
            if ($sta == 1){
                $collect_num = $collect_num+1;
            }else{
                $collect_num = $collect_num-1;
            }
            Db::name('headline')->where(['id'=>$id])->update(['collect_num'=>$collect_num]);
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

    /*
     * 点赞功能
     */
    public function like(Request $request)
    {
        // 文章id
        $id = $request->param('id');
        $token = $request->param('token');
        if ($id) {
            // 用户id
            $user_info = cache($token);
            $mid = $user_info['id'];
            $where['article_id'] = $id;
            $where['mid'] = $mid;
            $row = Db::name('favorite')->where($where)->find();
            if ($row) {
                if ($row['like'] == 1) {
                    // 改为收藏
                    $res = Db::name('favorite')->where($where)->update(['like' => '0']);
                    $msg = "已点赞";
                    $sta = 1;
                } else {
                    // 改为为收藏
                    $res = Db::name('favorite')->where($where)->update(['like' => '1']);
                    $msg = "已取消点赞";
                    $sta = 0;
                }
            } else {
                // 插入数据
                $data = ['like' => '0', 'mid' => $mid, 'article_id' => $id, 'add_time' => time()];
                $res = Db::name('favorite')->insert($data);
                $msg = "已点赞";
                $sta = 1;
            }
            $like_num = Db::name('headline')->where(['id'=>$id])->value('like_num');
            if ($sta == 1){
                $like_num = $like_num+1;
            }else{
                $like_num = $like_num-1;
            }
            Db::name('headline')->where(['id'=>$id])->update(['like_num'=>$like_num]);
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
