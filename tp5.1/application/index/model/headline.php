<?php

namespace app\index\model;

use think\Model;

class headline extends Model
{
    //
    public $pk='id';
    public static function getHeadLine($headlineId){
        return self::where('id',$headlineId)->select();
    }
    public static function decHeadLineCollect($headlineId){
        $headLine=new headline();
        return $headLine->save([
            'collect_num'  => ['dec', 1],
        ],['id' => $headlineId]);
    }
    public static function incHeadLineCollect($headlineId){
        $headLine=new headline();
        return $headLine->save([
            'collect_num'  => ['inc', 1],
        ],['id' => $headlineId]);
    }
    public static function decHeadLineLike($headlineId){
        $headLine=new headline();
        return $headLine->save([
            'like_num'  => ['dec', 1],
        ],['id' => $headlineId]);
    }

    public static function incHeadLineLike($headlineId){
        $headLine=new headline();
    return $headLine->save([
        'like_num'  => ['inc', 1],
    ],['id' => $headlineId]);;
}
}
