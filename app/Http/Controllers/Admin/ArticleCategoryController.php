<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleCategory;

class ArticleCategoryController extends Controller
{
    //文章分类管理
    

	//文章分类列表页面
    public function list()
    {
    	$res['list'] = ArticleCategory::getList();


    	return view('/admin/article/category/list',$res);
    }

    //文章分类添加页面
    public function add()
    {

    	return view('/admin/article/category/add');
    }

    //文章分类执行添加
    public function doAdd(Request $request)
    {
    	$params = $request->all();

    	if(!isset($params['cate_name']) || empty($params['cate_name'])){

    		return redirect()->back()->with('msg','文章分类名称不能为空');
    	}

    	unset($params['_token']);

    	$res = ArticleCategory::add($params);

    	if(!$res){
    		return redirect()->back()->with('msg','文章分类添加失败');
    	}

    	return redirect('/admin/article/category/list');
    }

    //文章分类添加页面
    public function edit($id)
    {
    	$assign['info'] = ArticleCategory::edit($id);

    	return view('/admin/article/category/edit',$assign);
    }

    //文章分类执行修改
    public function doEdit(Request $request)
    {

		$params = $request->all();

    	if(!isset($params['cate_name']) || empty($params['cate_name'])){

    		return redirect()->back()->with('msg','文章分类名称不能为空');
    	}

    	unset($params['_token']);

    	$data= [
    		'cate_name' => $params['cate_name'],
    		'cate_desc'	=>$params['cate_desc'],
    		'cate_order' =>$params['cate_order'],
    	];

    	$res = ArticleCategory::doEdit($data,$params['id']);

    	if(!$res){
    		return redirect()->back()->with('msg','文章分类添加失败');
    	}

    	return redirect('/admin/article/category/list');
    }

    //文章分类删除
    public function del($id)
    {
    	ArticleCategory::del($id);

    	return redirect('/admin/article/category/list');
    }
}
