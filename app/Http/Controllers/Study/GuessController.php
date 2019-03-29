<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study\Guess;
use Illuminate\Support\Facades\DB;


class GuessController extends Controller
{
   /************赌球***********/
   
   //添加 
   public function add(){

   		return view('study.guess.add');
   }

   //执行添加
   public function doAdd(Request $request)
   {

   		$params = $request->all();

   		unset($params['_token']);

   		$res = Guess::doAdd($params);

   		if($res){
   			return redirect('/study/guess/list');
   		}


   		
   }

   //展示列表
   public function list(Request $request)
   {

   		$assign['list'] = Guess::list();

   		return view('study.guess.list',$assign);
   }

   //我要竞猜
   public function guess(Request $request)
   {
   		$params = $request->all();

   		$res['info'] = Guess::guess($params);

   		return view('/study/guess/guess',$res);
   }

   //执行竞猜
   public function doGuess(Request $request)
   {

   		$params = $request->all();

   		unset($params['_token']);

   		$params['user_id'] = 1;

   		$data = DB::table('study_guess_record')->Where('team_id',$params['team_id'])->first();
   			
   		if(empty($data)){

   			$res = Guess::doGuess($params);

   		}else{

   			$res = Guess::editGuess($params);
   			
   		}

   		return redirect('/study/guess/list');
   		
   }


   //竞猜结果
   public function Result(Request $request)
   {

      $id = $request->input('id');

      //获取对阵信息
      $res['info'] = Guess::guess($id)->toArray();

      //获取竞猜信息
      $res['info2'] = DB::table('study_guess_record')->where('user_id',1)->where('team_id',$id)->first();

      // dd($res);
		return view('study.guess.result',$res);	
   }


}
