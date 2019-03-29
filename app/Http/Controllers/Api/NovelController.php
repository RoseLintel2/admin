<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Novel;

class NovelController extends Controller
{
    //小说书库列表
    
	public function bookList(Request $request)
	{

		$list = Novel::getLists()->toArray();
		// dd($list);
		$return = [
			'code' => 2000,
			'msg'  => '获取小说书库成功',
			'data' => [
				'page' 		  => $list['current_page'],
				'total_page'  => $list['last_page'],
				'list'        => $list['data']
			]
		];

		return json_encode($return);

	}

	//获取小说的阅读榜单
	public function bookRank(Request $request)
	{
		$num = $request->input('num',8);

		$list = Novel::getReadRank($num);

		$return = [
			'code' => 2000,
			'msg'  => '获取小说榜单成功',
			'data' => $list
		];

		return json_encode($return);
	}

	//获取小说详情接口
	public function detail($id)
	{
		$list = Novel::getApiNovelDetail($id);

		$return = [
			'code' => 2000,
			'msg'  => '获取小说详情成功',
			'data' => $list
		];

		return json_encode($return);
	}

}
