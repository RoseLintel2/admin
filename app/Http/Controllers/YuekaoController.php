<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YuekaoController extends Controller
{
    //月考抽奖
    public function index(){

    	return view('ks.ks');
    }

    //抽奖接口
    public function add(Request $request)
    {


    	//定义开始时间
    	$ks = date('Y-m-d 10:00:00');


    	//定义结束时间
		$js = date('Y-m-d 15:00:00');


    	$params = $request->all();

    	$return = [
    		'code' => 2000,
    		'msg'  => '成功',
    		'data' => []
    	];

    	//判断是否有手机号
    	if(!isset($params['phone']) || empty($params['phone'])){
    		$return = [
	    		'code' => 4001,
	    		'msg'  => '请输入手机号',
	    	
    		];

    		return json_encode($return);
    	}

    	//判断是否有手机号
    	if(!isset($params['user_id']) || empty($params['user_id'])){
    		$return = [
	    		'code' => 4002,
	    		'msg'  => '请输入用户id',
	    	
    		];

    		return json_encode($return);
    	}

    	//判断是否抽奖3次
    	$user = DB::table('study_lottery_record')->where('user_id',$params['user_id'])->where('created_at',date('Y-m-d'))->count();

    	if($user>=3){
    		$return = [
	    		'code' => 4003,
	    		'msg'  => '你抽奖次数以上限，明天再来',
	    	
    		];

    		return json_encode($return);
    	}


    	//判断是在特定时间抽奖
    	if( time() < strtotime($ks) || time() > strtotime($js )){

    		$return = [
	    		'code' => 4004,
	    		'msg'  => '请在特定时间进行抽奖',
	    	
    		];

    		return json_encode($return);
    	}


    	/*********执行抽奖**********/

    	//查询奖品表
    	$lottery = DB::table('study_lottery')->get()->toArray();

    	//记录
    	$jl = [];
    	//奖品
    	$jp = [];

    	foreach ($lottery as $k => $v) {
    		$jl[]=$v->precent;
    		$jp[]=$v->lottery_name;

    	}

    	// 几率总和
    	$jl2 = array_sum($jl);

    	// 随机数 GIAO
    	$giao = mt_rand(1,$jl2);

    	//结果
    	$jieguo = "";

    	//判断奖品
    	if( $giao == 1 ){
    		$jieguo=$jp[0];
    	}elseif( $giao == 2 || $giao == 3 || $giao == 4 ){
    		$jieguo=$jp[1];
    	}elseif( $giao == 5 || $giao == 6 || $giao == 7 || $giao == 8 || $giao == 9 ){
    		$jieguo=$jp[2];
    	}else{
    		$jieguo=$jp[3];
    	}	


    	//查询奖品id
    	$lotterys = DB::table('study_lottery')->where('lottery_name',$jieguo)->get()->toArray();
    	

    	//定义一个数组
    	$data = [
    		'user_id' => $params['user_id'],
    		'lottery_id' => $lotterys[0]->id,
    		'created_at' => date("Y-m-d")
    	];

    	//添加记录表
    	DB::table('study_lottery_record')->insert($data);

    	$return['data'] = $jieguo;

    	return json_encode($return);

    }

    //中奖者名单
    public function list($user_id = 2){

    	$users['list'] = DB::select(' select a.id,real_name,phone from study_lottery_user a LEFT JOIN study_lottery_record b on a.id = b.user_id WHERE b.user_id = ?',[$user_id]);
    	// dd($users);
    	return view('ks.kks',$users);
    }
}
