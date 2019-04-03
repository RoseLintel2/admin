<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\goodsType;

class goodsTypeController extends Controller
{
    //商品属性
    

	public function list()
	{
		$goodsType = new goodsType();

		$assign['list'] =$this->getList($goodsType);

		return view('/admin/goodsType/list',$assign);
	}

	//商品属性添加页面
	public function add()
	{

		return view('/admin/goodsType/add');
	}

	//商品属性执行添加
	public function doAdd(Request $request)
	{
		$params = $request->all();

		$params = $this->delToken($params);

		$goodsType = new goodsType();

		$res = $this->storeData($goodsType,$params);

		if(!$res){

			return redirect()->back()->with('msg','添加商品属性失败');

		}

		return redirect('/admin/goods/type/list');

	}

	//商品属性修改页面
	public function edit($id)
	{

		$goodsType = new goodsType();

		$res['info'] = $this->getDataInfo($goodsType,$id);

		return view('/admin/goodsType/edit',$res);
	}


	//商品属性执行修改
	public function doEdit(Request $request)
	{

		$params = $request->all();

		$params = $this->delToken($params);

		$goodsType = new goodsType();

		$id = $this->getDataInfo($goodsType,$params['id']);

		$res = $this->storeData($id,$params);

		if(!$res){

			return redirect()->back()->with('msg','修改商品属性失败');

		}

		return redirect('/admin/goods/type/list');

	}

	//商品属性删除
	public function del($id)
	{
		$goodsType = new goodsType();

		$this->delData($goodsType,$id);

		return redirect('/admin/goods/type/list');

	}


}
