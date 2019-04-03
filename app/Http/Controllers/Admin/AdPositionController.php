<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdPosition;

class AdPositionController extends Controller
{
    //广告位列表
    
    //广告位页面
    public function list()
    {

    	$assign['list'] = AdPosition::getList();

    	return view('admin.position.list',$assign);
    }

    //广告位添加页面
    public function add()
    {

    	return view('admin.position.add');
    }

    //执行广告位添加
    public function doAdd(Request $request)
    {
    	$params = $request->all();


    	$params = $this->delToken($params);
    	
    	$res = AdPosition::add($params);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect('/admin/position/list');
    }

    //广告位修改页面
    public function edit($id)
    {
    	$AdPosition = new AdPosition();

    	$res['info'] = $this->getDataInfo($AdPosition,$id);

    	return view('admin.position.edit',$res);
    }

    //广告位执行修改
    public function doEdit(Request $request)
    {
    	

    	$params = $request->all();


    	$params = $this->delToken($params);

    	

    	$AdPosition = AdPosition::edit($params['id']);

    	

    	$res = $this->storeData($AdPosition,$params);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect('/admin/position/list');


    }

    //广告位删除
    public function del($id)
    {
    	$AdPosition = new AdPosition();

    	$this->delData($AdPosition,$id);

    	return redirect('/admin/position/list');

    }


    
}
