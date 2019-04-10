<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    //指定表
    protected $table = "jy_comment";

   public static function getList($goodsId)
   {
   		 $sql = DB::select(' select a.id,b.goods_name,c.image_url,c.username,a.type,a.content from jy_comment a LEFT JOIN jy_goods as b on a.comment_id = b.id LEFT JOIN jy_user c on a.user_id = c.id where b.id =  ?',[$goodsId]);

    	// dd($sql);

    	return $sql;
   }
}
