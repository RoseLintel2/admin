<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\goodsAttr;
use App\Model\goodsType;
use Illuminate\Support\Facades\DB;

class goodsAttrController extends Controller
{
    //商品类型属性
    

    public function list($id)
    {	


    	$res['attr_list'] = DB::select(' select a.id as id , attr_name,type_name,input_type,attr_value,a.status from jy_goods_attr a LEFT JOIN jy_goods_type b on a.cate_id = b.id where b.id = ? ',[$id]);

        // dd($res);

    	return view('/admin/goodsAttr/list',$res);
    }

    //商品类型属性添加页面
    public function add()
    {

    	$goodsType = new goodsType();

    	$res['type_list'] = $this->getList($goodsType);

    	return view('/admin/goodsAttr/add',$res);
    }

    //商品类型属性执行添加
    public function doAdd(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);

    	$goodsAttr = new goodsAttr();

    	$res = $this->storeData($goodsAttr,$params);

    	if(!$res){

    		return redirect()->back()->with('msg','商品类型属性添加失败');
    	}

    	return redirect('/admin/goods/attr/list');
    }

    //商品类型修改页面
    public function edit($id)
    {

    	return view('/admin/goodsAttr/edit');
    }

    //商品类型执行修改
    public function doEdit(Request $request)
    {


    }

    //商品类型删除
    public function del($id)
    {


    }
   
}
