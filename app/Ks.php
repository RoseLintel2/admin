<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ks extends Model
{
    //指定表
    protected $table = "bs_bonus";

    public static function add($data){

    	return self::insert($data);
    }
    public static function list(){

    	return self::get()->toarray();
    }

}
