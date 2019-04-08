<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //品牌商品
    

    const 
        USE_ABLE = 1,//可用
        USE_DISABLE = 2,//禁用
        END = TRUE;
    
    protected $table = "jy_brand";

    public $timestamps = false;


    //商品品牌列表
    public static function doList()
    {
    	return self::get()->toArray();
    }

    //商品品牌删除
    public static function del($id){
    	return self::where('id',$id)->delete();
    }

    //商品品牌添加
    public static function doAdd($data){
    	return self::insert($data);
    }

    //商品品牌修改查询
    public static function edit($id){
    	return self::where('id',$id)->first();
    }
    //商品品牌执行修改
    public static function doEdit($data,$id){
    	return self::where('id',$id)->update($data);
    }
}
