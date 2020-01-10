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