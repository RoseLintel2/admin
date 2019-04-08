<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category2;
use App\Tools\ToolsAdmin;

class Category2Controller extends Controller
{
    //商品分类
    

    const 
        USE_ABLE = 1,//可用
        USE_DISABLE = 2,//禁用
        END = TRUE;
    
    
	// 商品分类列表
    public function list()
    {

    	return view('admin.category2.list');
    }

    //获取商品分类列表数据
    public function getListDate($fid = 0)
    {
        $res = Category2::getCategory2fid($fid);

        $return = [
            'code' => 2000,
            'msg'  => '获取商品分类列表成功',
            'data' => $res
        ];

        return json_encode($return);
    }

    //商品分类添加
    public function add()
    {
        $list = Category2::getCategory2List();

        $res['list'] = ToolsAdmin::buildTreeString($list,0,0,"f_id");

        // dd($res);

		return view('admin.category2.add',$res);
    }

    //商品分类执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        //认证
        if(!isset($params['cate_name']) || empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');

        }

        unset($params['_token']);
        // dd($params);
        $res = Category2::doAdd($params);

        if(!$res){
            return redirect()->back()->with('msg','商品分类添加失败');
        }

        return redirect('/admin/category2/list');

    }

    //商品分类删除
    public function del($id)
    {
        $res = Category2::del($id);

        $return = [
            'code' => 2000,
            'msg'  => '删除成功'
        ];

        return json_encode($return);
    }

    //商品分类修改页面
    public function edit($id)
    {
        $list = Category2::getCategory2List();
        $res['list'] = ToolsAdmin::buildTreeString($list,0,0,"f_id");

        $res['info'] = Category2::edit($id);

        return view('/admin/category2/edit',$res);
    }

    //商品分类执行修改
    public function doEdit(Request $request)
    {
        $params = $request->all();

         //认证
        if(!isset($params['cate_name']) || empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');

        }

        unset($params['_token']);
        
        $data=[
            'cate_name'=> $params['cate_name'],
            'status'   => $params['status'],
        ];

        $res = Category2::doEdit($data,$params['id']);

        if(!$res){
            return redirect()->back()->with('msg','商品分类添加失败');
        }

        return redirect('/admin/category2/list');

    }

    

}
