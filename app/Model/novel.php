<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;


class Novel extends Model
{
    //
    protected $table = "novel";


    //获取列表
    public function getList(){


        return self::select("novel.id",'c_name','author_name','c_id','a_id','name','image_url','status')
                ->join('category','novel.c_id','category.id')//连分类表
                ->join('author','novel.a_id','=','author.id')
                ->paginate(5);
    }




    //小说添加
    public function addRecord($data){
        
        return self::insert($data);
    }


    // 执行删除操作
    public function delRecord($id){
        return self::where('id',$id)->delete();
    }


    //小说修改
    public function editRecord($data, $id)
    {
        return self::where('id',$id)->update($data);    
    }




     //获取小说详情
    public function getNovelInfo($id)
    {
        return self::where('id', $id)->first();
    }





/*【-----------------小程序接口分割线--------------------】*/




    //获取小说banner图
    public static function bList($num = 3)
    {
        return $list =  self::select('id','image_url')
                    ->orderBy('id','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();

        
    }

    //获取最新小说
     public static function nList($num = 3)
    {
        return $list = self::select('novel.id','name','image_url','author_name','tags','c_name')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->orderBy('novel.id','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();
                    
        
    }

    //获取首页点击排行
    public static function cList($num = 3)
    {
        return $list =  self::select('novel.id','name','image_url','author_name','tags','c_name')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->orderBy('novel.clicks','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();
                    
        
    }


    //获取小说分类列表
    public static function getNovel($cid)
    {
        return $list =  self::select('category.id','name','image_url','author_name','tags','c_name')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->where('novel.c_id',$cid)
                    ->orderBy('novel.c_id','desc')
                    ->get()
                    ->toArray();
                    
        
    }

    //获取小说搜索列表
    public static function getNovelByName($name)
    {
        return $list =  self::select('novel.id','name','image_url','author_name','tags','c_name')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->where('novel.name','like','%'.$name.'%')
                    ->orWhere('author_name',$name)
                    ->orderBy('novel.id','desc')
                    ->get()
                    ->toArray();
                    
        
    }

    //获取小说书库列表
    public static function getLists()
    {
         return $list = self::select('novel.id','name','image_url','author_name','tags','c_name')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->orderBy('novel.id','desc')
                    ->paginate(3);
                    
    }

    //获取阅读排行
    public static function getReadRank($num = 8)
    {
        return $list =  self::select('novel.id','name','read_num')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->orderBy('novel.read_num','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();
    }

    //小说详情
    public static function getApiNovelDetail($id)
    {
        return $list = self::select('novel.id','name','image_url','author_name','tags','c_name','novel.desc')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->leftJoin('category','novel.c_id','=','category.id')
                    ->where('novel.id',$id)
                    ->first();
    }

    


}
