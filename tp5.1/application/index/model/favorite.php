<?php

namespace app\index\model;

use think\Model;

class favorite extends Model
{
    //
    public $pk='id';
    public static function getFavorite($userId){
        return self::where('mid',$userId)->where('collect',0)->select();
    }
    public static function getFavoriteCount($userId){
        return self::where('mid',$userId)->where('collect',0)->count();
    }
    public static function getFavoriteInfo($mid,$aid){
        return self::where('mid',$mid)->where('article_id',$aid)->where('collect',0)->select();
    }
    public static function delFavorite($mid,$aid){
        $favorite=new favorite();
        return $favorite->save([
            'collect' => 1
        ],[
            'mid'  => $mid,
            'article_id' =>$aid,
        ]);
    }

    public static function addFavorite($mid,$aid){
        $favorite=new favorite();
        $result=self::where('mid',$mid)->where('article_id',$aid)->select();
        if ($result){
            return $favorite->save([
                'collect' => 1
            ],[
                'mid'  => $mid,
                'article_id' =>$aid,
            ]);
        }
        return $favorite->save([
            'mid'  => $mid,
            'article_id' =>$aid,
            'add_time' =>time(),
            'collect' => 0
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
