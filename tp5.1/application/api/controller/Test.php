<?php

namespace app\api\controller;

use think\Controller;
use app\api\model\Test as TestModel;
use think\Request;
use think\Db;

class Test extends Controller
{

    public function demo(){
//       $id = $_GET('id');
       $rows=Db::table('three_activity as a')->where('id',$id)->Field('title,num')->select();
//       var_dump($rows);
       if (!$rows){
           return json(['error_code'=>10001,'msg'=>$this->error()],200);
       }

    }
    /*
     * 查询获得活动详情
     */
    public function getActiveDetail(){
        $id=$_GET('id');
        $row=Db::table('three_activity')->where('id',$id)->select();
        if ($row){
            return json(['error_code'=>0,'msg'=>$row],200);
        }
    }
    /*
     * 查询
     */
    public function select(){
        $name=$_POST('title');
        $rows=Db::table('three_activity')->where('title','like','%'.$name.'%')->select();
        if($rows){
            return json(['error_code'=>0,'msg'=>$rows],200);
        }else{
            return json(['error_code'=>10001,'msg'=>'亲,您搜索的内容不在我们活动范围内哦'],404);
        }

    }
    public function entry(){

        $data['uid']=session('id');
        $data['child_name'] = $_POST('name');
        $data['phone'] = $_POST('phone');
        $data['child_age'] = $_POST('age');
        $bool=Db::table('three_baoming')->insert($data);
        if($bool){
            return json(['error_code'=>0,'msg'=>$bool],200);
        }

    }
}
