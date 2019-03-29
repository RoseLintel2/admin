<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\category;

class categoryController extends Controller
{
    //小说类型
    

    public function list()
    {
    	$assign['categorys'] = category::getLists();

        return view('admin.category.list',$assign);

    }

    //小说类型添加页面
    public function create()
    {   

        return view('admin.category.create');

    }
    /**
     * 小说类型添加执行
     * @param  author_name   string  作者名字
     * @param  author_desc   string  作者描述
     */
    public function store(Request $request)
    {

        $params = $request->all();
        // dd($params);
        unset($params['_token']);

        $data = [
            'c_name' => $params['c_name'] ?? "",
            
        ];

        $res = category::addRecord($data);
        if(!$res){
            return redirect()->back();
        }
        return redirect('admin/category/list');

    }

    /**
     * 小说类型删除
     * @param   id   int  小说类型的id
     */
    
    public function del($id)
    {

        category::delRecord($id);

        return redirect('admin/category/list');
    }
}
