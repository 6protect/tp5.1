<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/4
 * Time: 9:53
 */

function jsonData($error=0, $msg, $res=[]){
    if ($res){
        $data = [
            'error_code' => $error,
            'msg' => $msg,
            'res' => $res
        ];
    }else{
        $data = [
            'error_code' => $error,
            'msg' => $msg
        ];
    }
    return $data;
}