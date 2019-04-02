<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;

class BrandController extends Controller
{
    //商品品牌
    

    //商品品牌列表页面
    public function list(){

    	return view('admin.brand.list');
    }

    //获取品牌列表数据
    public function doList(Request $requset){


    	$return = [ 
    		'code' => 2000,
    		'msg'  => '获取列表成功',
    		'data' => []
    	];

    	

    	$list = Brand::doList();

    	$return['data'] = $list;

    	return json_encode($return);
    }

    //商品品牌添加页面
    public function add(){

    	return view('admin.brand.add');
    }

    //商品品牌执行添加
    public function doAdd(Request $requset)
    {
    	$params = $requset->all();

    	$return = [
    		'code' => 4000,
    		'msg'  => '添加商品品牌失败'
    	];

    	if(!isset($params['brand_name']) || empty($params['brand_name'])){

    		return redirect()->back()->with('msg','品牌名称不能为空');
    	}

    	unset($params['_token']);

    	$res = Brand::doAdd($params);

    	if(!$res){
    		return json_encode($return);
    	}

    	return redirect('/admin/brand/list');
    }

    //商品品牌删除
    public function del(Request $requset){

    	$id = $requset->input('id');

    	$res = Brand::del($id);

    	$return = [
    		'code' => 2000,
    		'msg'  => '删除品牌成功'
    	];

    	if($res){
    		return json_encode($return);

    	}

    	return redirect('admin.brand.list');
    }

    //商品品牌修改
    public function edit($id){

    	
    	
    	$res['info'] = Brand::edit($id)->toArray();
    	// dd($res);

    	return view('admin.brand.edit',$res);
    }

    //商品执行添加
    public function doEdit(Request $requset){

    	$params = $requset->all();

    	$return = [
    		'code' => 4000,
    		'msg'  => '修改商品品牌失败'
    	];

    	if(!isset($params['brand_name']) || empty($params['brand_name'])){

    		return redirect()->back()->with('msg','品牌名称不能为空');
    	}

    	unset($params['_token']);

    	// dd($params);
    	$data = [
    		'brand_name' =>$params['brand_name'],
    		'status'	 => $params['status'],
    	];
    	$res = Brand::doEdit($data,$params['id']);

    	if(!$res){
    		return redirect()->back()->with('msg','修改商品品牌失败');
    	}

    	return redirect('/admin/brand/list');
    }

   
}
