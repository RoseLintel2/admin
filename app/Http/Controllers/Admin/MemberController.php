<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;

class MemberController extends Controller
{
    //会员列表
    public function list()
    {
    	$member = new Member();

    	$assign['member'] = $this->getPageList($member);
    	// dd($assign);

    	return view('/admin/member/list',$assign);
    }

    //详情
    public function detail($id)
    {

    	$member = new Member();

    	$assign['info'] = $member->getInfo($id);

    	return view('/admin/member/detail',$assign);
    }
}
