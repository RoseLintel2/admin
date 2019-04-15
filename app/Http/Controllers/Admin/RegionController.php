<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Region;
use App\Tools\ToolsAdmin;

class RegionController extends Controller
{
    //地区管理
    

    //列表
    public function list($fid=0)
    {

    	$region = new Region;

    	$where = ['f_id' => $fid];

    	$res['list'] = $this->getList($region,$where);
    	

    	return view('/admin/region/list',$res);
    }

    

    //地区添加页面
    public function add()
    {

    	$region = new Region;

    	$list = $this->getList($region);

    	// dd($list);

        $res['list'] = ToolsAdmin::buildTreeString($list,0,0,"f_id");

    	return view('/admin/region/add',$res);
    }

    //执行地区添加
    public function doAdd(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	$region = new Region;

    	$level = $this->getDataInfo($region,$params['f_id']);

    	$params['level'] = $level->level+1;

    	$res = $this->storeData($region,$params);

    	if(!$res){

    		return redirect()->back()->with('msg','地区添加失败');
    	}

    	return redirect('/admin/region/list/'.$params['f_id']);

    	

    }


    //删除地区
    public function del($id)
    {
    	$region = new Region;

    	$params = $this->getDataInfo($region,$id);

    	// dd($f_id);

    	$this->delData($region,$id);

    	return redirect('/admin/region/list/'.$params['f_id']);
    }
}
