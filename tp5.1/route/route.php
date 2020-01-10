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
Route::get('index/Personal', 'index/Personal/getUserInfo')->middleware('checkToken');
Route::get('index/Consult', 'index/Consult/index')->middleware('checkToken');
Route::get('index/Favorite', 'index/Favorite/index')->middleware('checkToken');
Route::get('index/HeadLine', 'index/HeadLine/create')->middleware('checkToken');
Route::patch('index/HeadLine', 'index/HeadLine/editFavorite')->middleware('checkToken');
Route::get('index/Invite', 'index/Invite/index')->middleware('checkToken');
Route::get('index/Score', 'index/Score/index')->middleware('checkToken');
Route::get('index/Inform', 'index/Inform/index')->middleware('checkToken');
Route::get('index/Token', 'index/Token/index');












Route::get('api/getMyEvents','api/MyEvents/getMyEvents'); //我的活动列表
Route::get('api/myEventsDetails','api/MyEvents/myEventsDetails');  //个人活动详情
Route::get('api/change','api/ChangeNumber/index'); //更换手机号
Route::get('api/byUserPhoneSendCode','api/ChangeNumber/byUserPhoneSendCode');  //通过用户手机号发送验证码
Route::get('api/verifyUserPhoneSendCode','api/ChangeNumber/verifyUserPhoneSendCode');  //验证用户手机号发送过来的验证码
Route::get('api/byUserInputPhoneSendCode','api/ChangeNumber/byUserInputPhoneSendCode');  //通过用户输入的手机号发送验证码
Route::get('api/verifyUserInputPhoneSendCode','api/ChangeNumber/verifyUserInputPhoneSendCode');    //验证用户输入的手机号发送过来的验证码
Route::get('api/getAllOrder','api/Orders/getAllOrder');    //获取全部订单
Route::get('api/getObligationOrder','api/Orders/getObligationOrder');    //获取待付款的订单
Route::get('api/getStudyingOrder','api/Orders/getStudyingOrder');    //获取学习中的订单
Route::get('api/getEndOrder','api/Orders/getEndOrder');   //获取学习结束的订单
return [

];



Route::get('demo','api/Test/demo');
Route::get('getActiveDetail','api/Test/getActiveDetail');
Route::get('select','api/Test/select');
Route::get('entry','api/Test/entry');