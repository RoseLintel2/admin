<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    //指定标
    protected $table = "jy_article_category";

    // public $timestamps= false;


    //获取文章分类列表
    public static function getList()
    {
    	return self::get()->toArray();
    }

    //文章分类添加
    public static function add($data)
    {
    	return self::insert($data);
    }

    //文章分类修改查询
    public static function edit($id)
    {
    	return self::where('id',$id)->first();
    }

    //文章分类执行修改
    public static function doEdit($data,$id)
    {
    	return self::where('id',$id)->update($data);
    }

    //文章分类删除
    public static function del($id)
    {
    	return self::where('id',$id)->delete();
    }
}
