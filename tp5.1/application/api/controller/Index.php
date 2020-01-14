<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
//验证器
use think\Validate;
//轮播图模型
use app\api\model\Carousel as CarouselModel;
//教师表模型
use app\api\model\Teachers as TeachersModel;
//课程表模型
use app\api\model\Course as CourseModel;
//活动表模型
use app\api\model\Activity as ActivityModel;

class Index extends Controller
{
    //获得轮播图链接(4)
    public function carousel()
    {
        $carousel = CarouselModel::getCarousel();
        if ($carousel) {
            return json(['error_code'=>0,'data'=>$carousel],200);
        }else{
            return json(['error_code'=>10001,'data'=>"资源未找到"],404);
        }
    }

    //获得首页明星教师(3)
    public function teachersList()
    {
        //按照教龄降序排序
    	$teachersList = TeachersModel::getTeacherList();
    	if ($teachersList) {
            return json(['error_code'=>0,'data'=>$teachersList],200);
        }else{
            return json(['error_code'=>10001,'data'=>"资源未找到"],404);
        }
        
    }

    //获得热门课程(4)
    public function courseList()
    {
        $courseList = CourseModel::getCourseList();
        
        if ($courseList) {
           return json(['error_code'=>0,'data'=>$courseList],200); 
        }else{
            return json(['error_code'=>10001,'data'=>"资源未找到"],404);
        }
    }

    //获得热门活动(4)
    public function activityList()
    {
        $activityList = ActivityModel::getActivityList();
        
        if ($activityList) {
           return json(['error_code'=>0,'data'=>$activityList],200); 
        }else{
            return json(['error_code'=>10001,'data'=>"资源未找到"],404);
        }
    }


}

