<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Study\BsBonus;//引入红包model
use App\Study\BsUser;//引入用户model
use App\Study\Bsbonusrecord;//引入红包记录model
use Log;

class BonusController extends Controller
{
    //红包首页
    public function index()
    {
    	

        return view('bonus/index');
    }

    /**
     * 抢红包的业务逻辑
     * 1，判断红包id和user_id是否传递
     * 2，判断一下红包是否存在
     * 3，判断红包是否抢光
     * 4，是否是最后一个人抢红包
     */
    public function getBonus(Request $request)
    {
    	/*1，判断红包id和user_id是否传递*/
    	
    	//获取所有传递过来的参数
    	$params = $request->all();

    	//接口返回的格式
    	$return = [
    		'code' => 2000,
    		'msg'  => '成功'
    	];

    	//判断用户user_id是否传递
    	if(!isset($params['user_id']) || empty($params['user_id'])){
    		$return = [
    			'code' => 4001,
    			'msg'  => '用户id不能为空'
    		];

    		return json_encode($return);
    	}

    	//判断红包bonus_id是否传递
    	if(!isset($params['bonus_id']) || empty($params['bonus_id'])){
    		$return = [
    			'code' => 4001,
    			'msg'  => '红包id不能为空'
    		];

    		return json_encode($return);
    	}

    	//用户id
    	$user_id = $params['user_id'];
    	//红包id
    	$bonus_id = $params['bonus_id'];

    	/*2，判断一下红包是否存在*/
    	$data1 = BsBonus::getBonusInfo($bonus_id);
    	// dd($data1);
    	if(empty($data1)){

    		$return = [
    			'code' => 4002,
    			'msg'  => '没有这个红包'
    		];
    		Log::info('判断红包是否存在');
    		return json_encode($return);
    	}

    	$record = Bsbonusrecord::getRecordById($user_id,$bonus_id);
        // dd($record);
    	if($record){

    		$return = [
    			'code' => 4004,
    			'msg'  => '你已经抢过这个红包了'
    		];
    		
    		return json_encode($return);

    	}

    	/*3，判断红包是否抢光*/
    	if($data1[0]['left_amount'] <= 0 || $data1[0]['left_num'] <= 0){

    		$return = [
    			'code' => 4003,
    			'msg'  => '红包已经被抢光'
    		];
    		Log::info('判断红包是被抢光');
    		return json_encode($return);
    	}

    	/*4，是否是最后一个人抢红包*/

    	if($data1[0]['left_num'] == 1){

    		Log::info('是否是最后一个人抢红包');
    		//用户抢到的金额
    		$getMoney = $data1[0]['left_amount'];

    		//插入用户抢到的一条bonus_record记录
    		$data = [
    			'user_id'  => $user_id,
    			'bonus_id' => $bonus_id,
    			'money'    => $getMoney,
    			'flag'     => 1
    		];
    		// dd($data);
    		Log::info('插入用户抢到的一条bonus_record记录');
    		Bsbonusrecord::createRecord($data);

    		//更新红包表的数据
    		
    		$data2 = [
    			'left_amount' => 0,
    			'left_num'   => 0
    		];

    		Log::info('更新红包表的数据');
    		BsBonus::updateBonusInfo($data2,$bonus_id);

    		//评选出运气王
    		
    		// 1，降序排列红包抢的记录
    		$res = Bsbonusrecord::getMaxBonus($bonus_id);

    		//2，更新抢红包的记录
    		Bsbonusrecord::updateBonusRecord(['flag'=>2],$res->id);
    	}else{

    		//最小金额
    		$min = 0.01;

    		//最大金额
    		$max = $data1[0]['left_amount'] - ($data1[0]['left_num'] -1 )*0.01;

    		//获取随机金额随机值
    		$getMoney = rand($min*100,$max*100)/100;

    		//插入用户抢到的一条bonus_record记录
    		$data3 = [
    			'user_id'  => $user_id,
    			'bonus_id' => $bonus_id,
    			'money'    => $getMoney,
    			'flag'     => 1
    		];

    		Bsbonusrecord::createRecord($data3);

    		//更新红包的金额
    		$data4 = [
    			'left_amount' => $data1[0]['left_amount'] - $getMoney,
    			'left_num'    => $data1[0]['left_num'] -1
    		];

    		BsBonus::updateBonusInfo($data4,$bonus_id);
    		
    	}
        return json_encode($return);
    }

     //红包添加路由
    public function addBonus(Request $request)
    {
    	//接收所有的参数
        $params = $request->all();

        //返回的格式
        $return = [
            'code' => 2000,
            'msg'  => '成功'
        ];

        $data = [
            'total_amount' => $params['total_amount'],
            'left_amount'  => $params['total_amount'],
            'total_num'    => $params['total_num'],
            'left_num'     => $params['total_num']
        ];
        // dd($data);
        BsBonus::addBonus($data);

        return json_encode($return);

    }

     //红包列表
    public function getList()
    {
    	$list = BsBonus::getlist();

    	$return = [
    		'code' => 2000,
    		'msg'  => '成功',
    		'data' => $list
    	];
        
    	return json_encode($return);
    }
    //人气王列表
    public function getMaxBonus(Request $request)
    {

        //接收所有的参数
        $params = $request->input('bouns_id');

        //运气王
        $flag = DB::select("select user_id from bs_bonus_record WHERE bonus_id = 11 ORDER BY money desc");
        // dd($flag);
        // 1，原生SQL
        $list = DB::select(" select a.id,a.username,a.image,b.money,b.flag from bs_user a LEFT JOIN bs_bonus_record b on a.id = b.user_id LEFT JOIN bs_bonus c on b.bonus_id = c.id WHERE c.id = ? ORDER BY money desc",[$params]);
        


        //2,
        // $users = DB::table('bs_user')
        //     ->leftJoin('bs_bonus_record', 'bs_user.id', '=', 'bs_bonus_record.user_id')
        //     ->leftJoin('bs_bonus', 'bs_bonus_record.bonus_id', '=', 'bs_bonus.id')
        //     ->where('bs_bonus.id',$params)
        //     ->orderBy('money','desc')
        //     ->get()->toArray();
        // dd($users);
        $users = [];
        foreach ($list as $k => $v) {
            $users[$k]['id'] = $v->id;
            $users[$k]['username'] = $v->username;
            $users[$k]['image'] = $v->image;
            $users[$k]['money'] = $v->money;
            $users[$k]['flag'] = $v->flag;
            
        }

        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => $users
        ];

        return json_encode($return);

       
    }


    
}
