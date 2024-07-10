<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
