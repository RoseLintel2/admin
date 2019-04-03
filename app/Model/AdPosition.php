<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    //指定表
    protected $table = "jy_ad_position";

    public $timestamps= false;


    //获取广告位列表
    public static function getList()
    {
    	return self::get()->toArray();
    }

    //广告位添加
    public static function add($data)
    {
    	return self::insert($data);
    }

    //广告位修改查询
    public static function edit($id)
    {
    	return self::where('id',$id)->first();
    }

    //广告位执行修改
    public static function doEdit($data,$id)
    {
    	return self::where('id',$id)->update($data);
    }

    //广告位删除
    public static function del($id)
    {
    	return self::where('id',$id)->delete();
    }
}
