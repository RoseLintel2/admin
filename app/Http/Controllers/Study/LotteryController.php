<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{
    //抽奖
    
    public function index(){

    	return view('study.lottery.index');
    }

    //添加
    public function add(Request $request)
    {
    	$params = $request->all();

    	//定义抽奖时间
    	$ks = date('Y-m-d 18:00:00');

    	//定义结束时间
    	$js = date('Y-m-d 23:00:00');

    	$return = [
    		'code' => 2000,
    		'成功' => '成功',
    		'data' => []
    	];

    	//判断是否有手机号
    	if(!isset($params['phone']) || empty($params['phone'])){

    		$return = [
    			'code' => 4001,
    			'msg'  => '手机号不能存在'
    		];

    		return json_encode($return);
    	}

    	//判断用户
    	if(!isset($params['user_id']) || empty($params['user_id'])){

    		$return = [
    			'code' => 4002,
    			'msg'  => '用户id不存在'
    		];

    		return json_encode($return);
    	}

    	//判断是否抽奖超过三次
    	
    	$user = DB::table('study_lottery_record')->where('user_id',$params['user_id'])->where('created_at',date("Y-m-d"))->count();
    	
    	
    	if($user >=3 ){

    		$return = [
    			'code' => 4003,
    			'msg'  => '你今天抽奖次数已用完'
    		];

    		return json_encode($return);
    	}

    	//判断是否在特定时间抽奖
    	
    	if( time() > strtotime($js) || time() < strtotime($ks) ){

    		$return = [
    			'code' => 4004,
    			'msg'  => '请在特定时间参与抽奖'
    		];

    		return json_encode($return);
    	}

    	//执行抽奖
    	

    	//获取奖品列表
    	$lottery = DB::table('study_lottery')->get()->toArray();

    	//奖品
    	$jp = [];
    	//几率
    	$jl = [];

    	foreach ($lottery as $k => $v) {
    		$jp[] = $v->lottery_name;
    		$jl[] = $v->precent;
    	}

    	$jl2=array_sum($jl);
    	
    	//随机概率
    	$preCurrent = mt_rand(1,$jl2);
    	// dd($jp);

    	//抽奖结果
    	$giao = '';

    	if($preCurrent == 1){
    		$giao = $jp[0];
    	}elseif ($preCurrent == 2 || $preCurrent == 3 || $preCurrent == 4) {
    		$giao = $jp[1];
    	}elseif ($preCurrent == 5 || $preCurrent == 6 || $preCurrent == 7 || $preCurrent == 8 || $preCurrent == 9) {
    		$giao = $jp[2];
    	}elseif ($preCurrent == 10) {
    		$giao = $jp[3];
    	}

    	$lottery2 = DB::table('study_lottery')->where('lottery_name',$giao)->first();
    	
    	//添加记录表
    	$data = [
    		'user_id' =>$params['user_id'],
    		'lottery_id' => $lottery2->id,
    		'created_at' => date('Y-m-d')
    	];
    	
    	DB::table('study_lottery_record')->insert($data);

    	$return['data'] = $giao;

    	return json_encode($return);
    }
}
