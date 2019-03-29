<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Novel;

class SearchController extends Controller
{
    //小程序小说搜索
    
	public function getNovelByName(Request $request)
	{

		$name = $request->input('naem');

		$list = Novel::getNovelByName($name);
		// dd($list);
		$totaNum = count($list);

		$return = [
			'code' => 2000,
			'msg'  => '小说搜索成功', 
			'data' => [
				'list' => $list,
				'num'  => $totaNum
			]
		];

		return json_encode($return);
	}

}
