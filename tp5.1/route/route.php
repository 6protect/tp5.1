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
return [

];

Route::get('getMyEvents','api/MyEvents/getMyEvents'); //�ҵĻ�б�
Route::get('myEventsDetails','api/MyEvents/myEventsDetails');  //���˻����
Route::get('change','api/ChangeNumber/index'); //�����ֻ���
Route::get('byUserPhoneSendCode','api/ChangeNumber/byUserPhoneSendCode');  //ͨ���û��ֻ��ŷ�����֤��
Route::get('verifyUserPhoneSendCode','api/ChangeNumber/verifyUserPhoneSendCode');  //��֤�û��ֻ��ŷ��͹�������֤��
Route::get('byUserInputPhoneSendCode','api/ChangeNumber/byUserInputPhoneSendCode');  //ͨ���û�������ֻ��ŷ�����֤��
Route::get('verifyUserInputPhoneSendCode','api/ChangeNumber/verifyUserInputPhoneSendCode');    //��֤�û�������ֻ��ŷ��͹�������֤��
Route::get('getAllOrder','api/Orders/getAllOrder');    //��ȡȫ������
Route::get('getObligationOrder','api/Orders/getObligationOrder');    //��ȡ������Ķ���
Route::get('getStudyingOrder','api/Orders/getStudyingOrder');    //��ȡѧϰ�еĶ���
Route::get('getEndOrder','api/Orders/getEndOrder');   //��ȡѧϰ�����Ķ���

