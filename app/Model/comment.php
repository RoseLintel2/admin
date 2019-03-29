<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
    //
    protected $table="comment";
    //获取评论列表
    public function getLists()
    {
    	return self::select('comment.id','novel.name','user.username','content','comment.status')
		    		->leftJoin('novel','novel.id','=','comment.novel_id')
		    		->leftJoin('user','user.id','=','comment.user_id')
		    		->orderBy('comment.id','desc')
		    		->paginate(5)
		    		->toArray();
    }
    public function checkComment($id)
    {
    	return self::where('id',$id)->where('status',1)->update(['status'=>2]);
    }
    public function delRecord($id)
    {
    	return self::where('id',$id)->delete();
    }



    //小程序评论接口
    
    public static function getAdd($data)
    {
        return self::insert($data);
    }

    //小程序列表接口
     public static function getList($data)
    {
        return self::insert($data);
    }

    //小程序删除接口
     public static function getDel($id)
    {
        return self::where('id',$id)->delete();
    }
}