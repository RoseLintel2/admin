<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\category;
use App\Model\Novel;

class CategoryController extends Controller
{
    //小说分类
    

    //获取小说分类列表
    public function getCategory(Request $request)
    {

    	$list = category::getCategory();

    	$return = [
    		'code' => 2000,
    		'msg'  => '获取小说分类成功',
    		'data' => $list
    	];

    	return json_encode($return);

    }

    //获取分类小说列表
    public function getNovel(Request $request)
    {
    	$cid = $request->input('c_id');

    	// dd($cid);

    	$list = Novel::getNovel($cid);
    	// dd($list);
    	$return = [
    		'code' => 2000,
    		'msg'  => '获取分类小说列表成功',
    		'data' => $list
    	];

    	return json_encode($return);
    }

}
