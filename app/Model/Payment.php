<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //指定表
    protected $table = "jy_payment";

    public $timestamps = false;
    
}
