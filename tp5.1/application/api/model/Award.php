<?php

namespace app\api\model;

use think\Model;

class Award extends Model
{
    //5.1中模型不会自动获取主键名称，必须设置pk属性。默认为'id'
    protected $pk = "id";
}
