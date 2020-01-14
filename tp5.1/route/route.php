<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
Route::get('hello/:name', 'index/hello');
Route::get('index/Ticket', 'index/Ticket/getTicket')->middleware('checkToken');
Route::get('index/Personal', 'index/Personal/index')->middleware('checkToken');
Route::get('index/Consult', 'index/Consult/index')->middleware('checkToken');
Route::get('index/Favorite', 'index/Favorite/index')->middleware('checkToken');
Route::get('index/HeadLine', 'index/HeadLine/create')->middleware('checkToken');
Route::patch('index/HeadLine', 'index/HeadLine/editFavorite')->middleware('checkToken');
Route::get('index/Invite', 'index/Invite/index')->middleware('checkToken');
Route::get('index/Score', 'index/Score/index')->middleware('checkToken');
Route::get('index/Inform', 'index/Inform/index')->middleware('checkToken');
Route::get('index/Token', 'index/Token/index');












Route::get('api/getMyEvents','api/MyEvents/getMyEvents'); //??????
Route::get('api/myEventsDetails','api/MyEvents/myEventsDetails');  //??????
Route::get('api/change','api/ChangeNumber/index'); //?????
Route::get('api/byUserPhoneSendCode','api/ChangeNumber/byUserPhoneSendCode');  //????????????
Route::get('api/verifyUserPhoneSendCode','api/ChangeNumber/verifyUserPhoneSendCode');  //???????????????
Route::get('api/byUserInputPhoneSendCode','api/ChangeNumber/byUserInputPhoneSendCode');  //???????????????
Route::get('api/verifyUserInputPhoneSendCode','api/ChangeNumber/verifyUserInputPhoneSendCode');    //??????????????????
Route::get('api/getAllOrder','api/Orders/getAllOrder');    //??????
Route::get('api/getObligationOrder','api/Orders/getObligationOrder');    //????????
Route::get('api/getStudyingOrder','api/Orders/getStudyingOrder');    //????????
Route::get('api/getEndOrder','api/Orders/getEndOrder');   //?????????
return [

];



Route::get('demo','api/Test/demo');
Route::get('getActiveDetail','api/Test/getActiveDetail');
Route::get('select','api/Test/select');
Route::get('entry','api/Test/entry');




Route::group('home/',function (){
    Route::get('Demo/seachCourse','api/Test/seachCourse');
    Route::get('Demo/favorite','api/Test/favorite');
    Route::get('Demo/hotCourse','api/Test/hotCourse');
    Route::get('Demo/details','api/Test/details');
    Route::get('Demo/buy','api/Test/buy');
    Route::get('Demo/order','api/Test/order');
    Route::get('Demo/orderAction','api/Test/orderAction');
})->middleware('CheckPengGe');


//注册
Route::post('user/register','api/User/register');

//获得注册验证码
Route::post('user/verifyCode','api/User/verifyCode');

//登录
Route::get('user/login','api/User/login');

//获得token
Route::get('token','api/Token/getToken');

//首页轮播图
Route::get('index/carousel','api/Index/carousel');

//首页明星教师
Route::get('index/teachersList','api/Index/teachersList');

//首页热门课程
Route::get('index/courseList','api/Index/courseList');

//首页热门活动
Route::get('index/activityList','api/Index/activityList');
















































































