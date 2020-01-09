<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/4
 * Time: 9:14
 */
Route::group('headline/',function (){
    Route::post('headList','home/EducationHead/headList');
    Route::post('headSeach','home/EducationHead/headSeach');
    Route::post('headDateils','home/EducationHead/headDateils');
    Route::post('like','home/EducationHead/like');
    Route::post('collect','home/EducationHead/collect');
})->middleware('CheckPengGe');

