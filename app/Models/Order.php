<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orders_products(){
        return $this->hasMany('App\Models\OrdersProduct', 'order_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public static function user_name(){
        $user_name = Order::get('name');
    }
}
