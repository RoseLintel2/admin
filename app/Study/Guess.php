<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guess extends Model
{

	protected $table = "study_guess";

	public $timestamps = false;


	//执行添加
	public static function doAdd($data){

		return self::insert($data);
	}
	//列表展示
	public static function list(){
		return self::get()->toArray();
	}
	//我要竞猜
	public static function guess($id){

		return self::where('id',$id)->first();
	}
	//执行竞猜
	public static function doGuess($data){

		return $sql = DB::table('study_guess_record')->insert($data);
	}
	//修改竞猜
	public static function editGuess($data){

		return $sql = DB::table('study_guess_record')->where('team_id',$data['team_id'])->update($data);
	}



}
