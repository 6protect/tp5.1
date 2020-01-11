<?php

namespace app\api\controller;

use http\Params;
use think\Controller;
use think\Db;
use think\Request;

class Demo extends Controller
{

    //热门课程页面
    public function hotCourse(Request $request){
    $row = Db::table('three_course')->where('active',1)->find();
    return json(['error_code'=>0,'msg'=>$row],200);
    $this->display();
    }
    //热门课程搜索
    public function seachCourse(Request $request){
        $word =  $request->param('word');
       $map[] = ['course_name','like','%'.$word.'%'];
       $seachs = Db::table('three_course')->where($map)->count();
       $seach = Db::table('three_course')->where($map)->select();
       $row = compact('seachs','seach');
       if ($seach){
           return json(['error_code'=>0,'msg'=>$row],200);
       }else{
           return json(['error_code'=>1,'msg'=>'请求商品不存在'],404);
       }


    }
    //课程详情页
    public function details(Request $request){
     $cid =  $request->param('cid');
     $res = Db::table('three_course')
        ->join('three_teachers','three_course.tid = three_teachers.id')
         ->where('three_course.id','1')
         ->field('course_name,image,price,description,three_teachers.username,itro,avatat')
         ->select();
     if ($res){
         return json(['error_code'=>0,'msg'=>$res],200);
     }else{
         return json(['error_code'=>1,'msg'=>'未找到'],404);
     }
    }
    //收藏
    public function favorite(Request $request){
        $token =  $request->param('token');
        $userinfo = cache($token);
        $where['mid'] = $userinfo['id'];
        $where['cid'] = $request->param('cid');
        $where['add_time'] = time();
        $bool = Db::table('three_favorite')->where('cid',$where['cid'])->find();
        if ($bool){
            Db::table('three_favorite')->where('id',$where['mid'])->where('cid',$where['cid'])->delete();
           return json(['error_code'=>0,'msg'=>'已取消收藏'],200);
        }else{
            Db::table('three_favorite')->where('id',$where['mid'])->insert($where);
            return json(['error_code'=>1,'msg'=>'添加成功'],400);
        }
    }
    //购买处理
    public function buy(Request $request){
        $token =  $request->param('token');
        $userinfo = cache($token);
        $where['mid'] = $userinfo['id'];
        $where['cid'] =$this->request('cid');
        $where['order_price'] =$this->request('order_price');
        $where['add_time'] = time();
        $where['order_syn'] = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $res = Db::table('three_member')->where('id',$where['mid'])->value('mobile');
        if ($res){
            $row = Db::table('three_orders')->insert($where);
            return json(['error_code'=>0,'msg'=>'加入订单'],200);
        }else{
            return json(['error_code'=>1,'msg'=>'未注册'],401);
        }
    }
//订单页面
    public function order(Request $request){
       $cid =  $request->param('cid');
        $token =  $request->param('token');
        $userinfo = cache($token);
        $where['mid'] = $userinfo['id'];
       $row = Db::table('three_member')
           ->alias('m')
           ->join('three_my_ticket t','m.id = t.mid')
           ->join('three_ticket k','t.tid = k.id')
           ->where('m.id',$where['mid'])
           ->field('username,mobile,score,discount,die_time,get_method,condition')
           ->select();
       if ($row){
           return json(['error_code'=>0,'msg'=>$row],200);
       }else{
           return json(['error_code'=>1,'msg'=>'未找到'],404);
       }
    }
    //订单处理
    public function orderAction(Request $request){
        $token =  $request->param('token');
        $userinfo = cache($token);
        $where['mid'] = $userinfo['id'];
        $score =  $request->param('score');
        $get_score = $request->param('get_score');
        $tid =  $request->param('tid');
        $total =  $request->param('money');

       $row = Db::table('three_member')->where('id',$where['mid'])->find();
       $money['money'] = $row['money']-$total;
       $mo = Db::table('three_member')->where('id',$where['mid'])->update($money);
    if ($mo){
        return json(['error_code'=>0,'msg'=>'支付成功'],200);
        Db::table('three_member')->where('id',$where['mid'])->find();
        $new_score = $row['score']-$score;
        Db::table('three_member')->where('id',$where['mid'])->update($new_score);
        $tik = Db::table('three_my_ticket')->where('id',$tid)->delete();
        $now_score = $row['score']+$get_score;
        $pi = Db::table('three_member')->where('id',$where['mid'])->update($now_score);
    }else{
        return json(['error_code'=>1,'msg'=>'支付失败'],100);
    }


    }
}
