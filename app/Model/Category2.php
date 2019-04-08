<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category2 extends Model
{
    //指定表
    
    const 
        USE_ABLE = 1,//可用
        USE_DISABLE = 2,//禁用
        END = TRUE;
    
    protected $table = "jy_category";

    public $timestamps = false;

    //获取商品分类列表数据
    public static function getCategory2List()
    {
    	$list = self::get()->toArray();

    	return $list;
    }
    //通过fid查询子分类
    public static function getCategory2fid($fid=0)
    {
    	$list  = self::where('f_id',$fid)->get()->toArray();

    	return $list;
    }

    //添加商品分类数据
    public static function doAdd($data)
    {
    	return self::insert($data);
    }

    //删除商品分类
    public static function del($id)
    {
    	return self::where('id',$id)->delete();
    }

    //商品分类修改查询
    public static function edit($id)
    {
    	return self::where('id',$id)->first();
    }
    //商品分类执行修改
    public static function doEdit($data,$id)
    {
    	return self::where('id',$id)->update($data);
    }
}
