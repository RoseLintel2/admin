<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Comment;

class CommentController extends Controller
{
    //商品评论
    


    public function list($goodsId)
    {
    	
    	$res['comment'] = Comment::getList($goodsId);

    	

    	return view('/admin/comment/list',$res);
    }

     public function del($id)
    {
    	
    	$comment  = new Comment();

    	$this->delData($comment,$id);

    	

    	return redirect()->back();
    }
}
