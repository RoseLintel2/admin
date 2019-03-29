<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Bsbonusrecord extends Model
{
    //自定义表名
    protected $table = "bs_bonus_record";

    /**
     * 创建一条记录
     * $data array
     */
    
    public static function createRecord($data)
    {
    	$res = self::insert($data);

    	return $res;
    }

     /**
     * 获取最大的金额红包
     * $bouns_id int
     */
    
    public static function getMaxBonuss($bouns_id)
    {

    	$res = self::select('id','money')
    		->where('bonus_id',$bouns_id)
    		->orderBy('money','desc')
    		->first();
        
        

    	return $res;
    }

    /**
     * 更新抢红包的记录
     */
    
    public static function updateBonusRecord($data,$id)
    {
    	return self::where('id',$id)->update($data);
    } 

    /**
     * 通过用户id和红包id获取红包的记录
     */
    public static function getRecordById($user_id,$bonus_id){

    	$res = self::where('user_id',$user_id)
    			->where('bonus_id',$bonus_id)
    			->first();

    	return $res;
    }

}
