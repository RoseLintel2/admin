<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;

class CommentController extends Controller
{
    //小程序评论
    

    //评论添加
    public function add(Request $request)
    {
    	$params = $request->all();

    	$return = [
    		'code' => 2000,
    		'msg'  => '评论成功'
    	];

    	$data= [
    		'novel_id' => $params['novel_id'] ,
    		'user_id'  => 1,
    		'content'  => $params['content']
    	];

    	$res = Comment::getAdd($data);

    	if(!$res){
    		
    		$return = [
    			'code' => 4002,
    			'msg'  => '评论失败'
    		];
    	}

    	return json_encode($return);

    }

    //评论列表
    

    //评论删除
    
}
