<?php

namespace app\index\model;

use think\Model;

class favorite extends Model
{
    //
    public $pk='id';
    public static function getFavorite($userINfo){
        return self::where('mid',$userINfo['id'])->select();
    }
    public static function getFavoriteCount($userId){
        return self::where('mid',$userId)->count();
    }
    public static function delFavorite($mid,$aid){
        return self::where('mid',$mid)->where('article_id',$aid)->delete();
    }
    public static function getFavoriteInfo($mid,$aid){
        return self::where('mid',$mid)->where('article_id',$aid)->select();
    }
    public static function addFavorite($mid,$aid){
        $favorite=new favorite();
        return $favorite->save([
            'mid'  => $mid,
            'article_id' =>$aid,
            'add_time' =>time()
        ]);
    }
    public static function addFavoriteLike($mid,$aid){
        $favorite=new favorite();
        return $favorite->save([
            'like' =>0
        ],[
            'mid'  => $mid,
            'article_id' =>$aid,
        ]);
    }
    public static function delFavoriteLike($mid,$aid){
        $favorite=new favorite();
        return $favorite->save([
            'like' =>1
        ],[
            'mid'  => $mid,
            'article_id' =>$aid,
        ]);
    }
}
