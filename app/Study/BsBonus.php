<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonus extends Model
{
    //自定义表名
    protected $table = "bs_bonus";

    /**
     * 获取红包信息
     * @param  $id
     */
    public static function getBonusInfo($id){

    	$data1 = self::where('id',$id)->get()->toarray();

    	return $data1;
    }

     /**
     * 更新红包信息
     * @param  $id
     */
    public static function updateBonusInfo($data,$id){

    	$data2 = self::where('id',$id)->update($data);
    	
    	return $data2;
    }

     /**
     * 添加红包信息
     * @param  $data
     */
    public static function addBonus($data){

    	$data3 = self::insert($data);

    	return $data3;
    }

     /**
     * 获取红包列表
     * @param  
     */
    public static function getlist(){

    	$data4 = self::get()->toarray();

    	return $data4;
    }
}
