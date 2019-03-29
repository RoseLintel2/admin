<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\author;

class AuthorController extends Controller
{
    //作者
    
    public function list()
    {
    	$assign['authors'] = author::getLists();

        return view('admin.author.list',$assign);

    }

    //作者添加页面
    public function create()
    {   

        return view('admin.author.create');

    }
    /**
     * 作者添加执行
     * @param  author_name   string  作者名字
     * @param  author_desc   string  作者描述
     */
    public function store(Request $request)
    {

        $params = $request->all();

        unset($params['_token']);

        $data = [
            'author_name' => $params['author_name'] ?? "",
            'author_desc' => $params['author_desc'] ?? ""
        ];

        $res = author::addRecord($data);
        if(!$res){
            return redirect()->back();
        }
        return redirect('admin/author/list');

    }

    /**
     * 作者删除
     * @param   id   int  作者的id
     */
    
    public function del($id)
    {

        author::delRecord($id);

        return redirect('admin/author/list');
    }
    
}
