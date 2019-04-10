<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shipping;

class ShippingController extends Controller
{
    
    //配送方式
    public function list()
    {

    	$shipping = new Shipping();

    	$res['shipping'] = $this->getDataList($shipping);


    	return view('admin.shipping.list',$res);
    }

    //添加页面
    public function add()
    {

    	return view('admin.shipping.add');
    }

    //执行添加
    public function doAdd(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);

    	$shipping = new Shipping();

    	$res = $this->storeData($shipping,$params);

    	if(!$res){

    		return redirect()->back()->with('msg','添加配送方式失败');
    	}

    	return redirect('/admin/shipping/list');
    }

    //配送删除
    public function del($id)
    {

    	$shipping = new Shipping();

    	$this->delData($shipping,$id);

    	return redirect('/admin/shipping/list');
    }

}
