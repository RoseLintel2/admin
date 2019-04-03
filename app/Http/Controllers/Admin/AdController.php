<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Ad;
use App\Model\AdPosition;
use App\Tools\ToolsAdmin;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    //广告
    

    //广告列表
    public function list()
    {
    	

    	 try{
            DB::beginTransaction();//开始事务
           	

           
    		$res['list'] = DB::select('select b.position_name ,a.* from jy_ad a LEFT JOIN jy_ad_position b on a.position_id = b.id  ');

    		
           	
           	// dd($res);
            DB::commit();//提交事务

        }catch(\Exception $e){

            DB::rollback();

           
        }

    	return view('/admin/ad/list',$res);
    }

    //广告添加页面
    public function add()
    {	

    	$res['AdPosition'] = AdPosition::getList();

    	return view('/admin/ad/add',$res);
    }

    //执行广告添加
    public function doAdd(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);

    	if(!isset($params['image_url']) || empty($params['image_url']) )
    	{
    		return redirect()->back()->with('msg','广告图片不能为空');
    	}

    	$params['image_url'] = ToolsAdmin::uploadFile($params['image_url']);
    	// dd($params);
    	
    	$AdPosition = new Ad();

    	$res = $this->storeData($AdPosition,$params);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect('/admin/ad/list');
    }

    //广告修改页面
    public function edit($id)
    {
		$ad = new Ad();

		$res['AdPosition'] = AdPosition::getList();

		$res['info'] = $this->getDataInfo($ad,$id);

    	return view('/admin/ad/edit',$res);
    }

    //执行广告添加
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	$AdPosition = new Ad();

    	$id = $this->getDataInfo($AdPosition,$params['id']);
    	// dd($id->image_url);

    	if(!isset($params['image_url']) || empty($params['image_url']) )
    	{
    		$params['image_url'] = $id->image_url;
    	}else{
    		// dd($params);
    		$params['image_url'] = ToolsAdmin::uploadFile($params['image_url']);
    	}
    	
    	

    	$res = $this->storeData($id,$params);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect('/admin/ad/list');
    }

    //广告删除
    public function del($id)
    {	
    	$ad = new Ad();

    	$this->delData($ad,$id);

    	return redirect('/admin/ad/list');
    }
}
