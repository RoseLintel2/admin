<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\goodsGallery;

class GoodsGalleryController extends Controller
{
    //商品相册列表数据
    

    public function getGallery($goods_id)
    {

    	$return = [
    		'code' => 2000,
    		'msg'  => '获取列表成功'

    	];
        // dd($return);

    	$gallery = new goodsGallery();

    	$where = [
    		'goods_id' => $goods_id
    	];

    	$list = $this->getDataList($gallery,$where);
        
    	$return['data'] = $list;
        // dd($gallery);
    	return json_encode($return);
    }


    //执行相册删除操作
    
    public function del($id)
    {


    	$return = [

    		'code' => 2000,
    		'msg'  => '删除相册成功'
    	];

    	$gallery = new goodsGallery();

    	$res = $this->delData($gallery , $id);

    	if(!$res){

    		$return = [
    			'code' => 4000,
    			'msg'  => '删除相册失败'
    		];

    	} 

    	return json_encode($return);

    }

}
