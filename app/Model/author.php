<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    //指定表名  作者
    protected $table = "author";

    const PAGE_SIZE = 5;

    /**
     * 作者分页展示
     */
    public static function getLists()
    {
    	return self::paginate(self::PAGE_SIZE);
    }

    /**
     * 作者添加
     */
    
    public static function addRecord($data)
    {
        return self::insert($data);
    }

     /**
     * 作者删除
     * @param   id   int  作者的id
     */
    
    public static function delRecord($id)
    {
        return self::where('id',$id)->delete();
    }

    //列表
    public static function getAuthor()
    {
        return self::get()->toArray();
    }

}
