<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //分类表
    protected $table ="category";

    const PAGE_SIZE = 5;

    /**
     * 小说类型分页展示
     */
    public static function getLists()
    {
    	return self::paginate(self::PAGE_SIZE);
    }

    /**
     * 小说类型添加
     */
    
    public static function addRecord($data)
    {
        return self::insert($data);
    }

     /**
     * 小说类型删除
     * @param   id   int  小说类型的id
     */
    
    public static function delRecord($id)
    {
        return self::where('id',$id)->delete();
    }

    //列表
    public static function getCategory()
    {
        return self::get()->toArray();
    }
}
