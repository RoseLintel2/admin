<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Activity;

class ActivityController extends Controller
{
    //运维管理
    

	//活动配置列表
    public function list()
    {	

    	$Activity = new Activity();

    	$res['activity_list'] = $this->getList($Activity);


    	return view('/admin/activity/list',$res);
    }

    //活动配置添加页面
    public function add()
    {

    	return view('/admin/activity/add');
    }


    //活动配置执行添加
    public function doAdd(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);

    	//处理支付方式的配置信息，进行序列化
    	if(!empty($params['active_config'])){

    		$active_config = [];

    		$arr = explode('|', $params['active_config']);

    		foreach ($arr as $key => $value) {
    			$arr1 = explode("=>",$value);

    			$active_config[$arr1[0]] = $arr1[1];
    		}

    		$params['active_config'] = serialize($active_config);
    	}

    	$Activity = new Activity();

    	$res = $this->storeData($Activity,$params);

    	if(!$res){

    		return redirect()->back()->with('msg','添加活动配置失败');
    	}

    	return redirect('/admin/activity/list');
    }


    //活动配置修改页面
    public function edit($id)
    {
    	$Activity = new Activity();

    	$res['info'] = $this->getDataInfo($Activity,$id);

    	return view('admin.activity.edit',$res);
    }


    //执行活动配置修改
    public function doEdit(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);

    	//处理支付方式的配置信息，进行序列化
    	if(!empty($params['active_config'])){

    		$active_config = [];

    		$arr = explode('|', $params['active_config']);

    		foreach ($arr as $key => $value) {

    			$arr1 = explode("=>", $value);

    			$active_config[$arr1[0]] = $arr1[1];

    		}

    		$params['active_config'] = serialize($active_config);
    	}

    	// $Activity = new Activity();

    	$Activity = Activity::find($params['id']);

    	$res = $this->storeData($Activity, $params);

    	if(!$res){
    		
    		return redirect()->back()->with('msg','修改活动配置失败');
    	}

    	return redirect('/admin/activity/list');
    }

    //活动配置删除
    public function del($id)
    {
    	$Activity = new Activity();

    	$this->delData($Activity,$id);

    	return redirect('/admin/activity/list');
    }



}
