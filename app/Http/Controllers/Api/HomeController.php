<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Novel;

class HomeController extends Controller
{
    //小程序接口
    

	//首页banner图接口
	public function bLists(Request $request)
	{

		$num = $request->input('num',3);

		$bList = Novel::bList();
		// dd($bList);
		$return = [
			'code' => 2000,
			'msg'  => '获取首页Banner成功',
			'data' => $bList
		]; 
		// dd($return);
		return json_encode($return);
	}

	//获取最新小说
	public function nLists(Request $request)
	{

		$num = $request->input('num',3);

		$nList = Novel::nList();

		$return = [
			'code' => 2000,
			'msg'  => '获取最新小说成功',
			'data' => $nList
		]; 

		return json_encode($return);
	}

	//获取小说排行
	public function cLists(Request $request)
	{

		$num = $request->input('num',3);

		$cList = Novel::cList();

		$return = [
			'code' => 2000,
			'msg'  => '获取小说排行成功',
			'data' => $cList
		]; 

		return json_encode($return);
	}

}
