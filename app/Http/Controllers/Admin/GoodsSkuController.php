<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\goods;
use App\Model\goodsAttr;
use App\Model\GoodsSku;

class GoodsSkuController extends Controller
{
    //
    

	//商品属性或sku的编辑页面
    public function edit($goodsId)
    {

    	//商品的详情
    	$goods = new goods();

    	$goods_info = $this->getDataInfo($goods,$goodsId);

    	//手动录入的商品的属性
    	$goods_attr = new goodsAttr();

    	
    	//手动录入的通用属性
    	$where = [
    			'cate_id' => $goods_info->type_id
    	];

    	$handle = $goods_attr->getAttrHandle($where);

    	//商品已经绑定过得属性关系
    	$goodsSku = new GoodsSku();

    	$spu = $goodsSku->getSpuHandle($goodsId);

    	foreach ($handle as $key => $value) {

    		foreach ($spu as $k => $v) {

    			if($value['id'] == $v['attr_id']){

    				$value['sku_value'] = $v['sku_value'];
    			}
    		}

    		$handle[$key] = $value;
    	}

    	$res['handle'] = $handle;

    	$res['goods_id'] = $goods_info->id;

    	return view('admin.goodsSku.edit',$res);
    }

    //商品SKU执行添加
    public function doEdit(Request $request)
    {

    	//接收所有的参数
    	$params = $request->all();

    	dd($params);
    }

    //获取sku属性列表接口
    public function getSkuAttr($goodsId)
    {

    	$return = [
    		'code' => 2000,
    		'msg'  => '成功'

    	];

    	//商品的详情
    	$goods = new goods();

    	$goods_info = $this->getDataInfo($goods,$goodsId);

    	//列表录入的商品的属性
    	$goodsAttr = new goodsAttr();

    	$where = [

    		'cate_id' => $goods_info->type_id

    	];

    	$data = $goodsAttr->getAttrList($where);

    	$return['data'] = $data;

    	return json_encode($return);

    }

    //获取属性的value值
    public function getAttrValue($id)
    {

    	//列表录入的商品属性
    	$goodsAttr = new goodsAttr();

    	$data = $goodsAttr->getAttrValue($id);

    	$string = str_replace('"""','',$data->attr_value);

    	$arr = explode("\r\n",$string);

    	$return = [

    		'code' => 2000,
    		'msg'  => '成功',
    		'data' => $arr

    	]; 

    	return json_encode($return);
    }


}
