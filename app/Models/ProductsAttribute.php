<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    use HasFactory;
    public static function productstock($product_id, $size){
        $productStock = ProductsAttribute::select('stock')->where(['product_id'=>$product_id, 'size'=>$size])->first();
        return $productStock->stock;
    }

    // public static function productAttribute($product_id){
    //     $productAttribute = ProductsAttribute::get()?->where('id', $product_id)?->first();
    //     return $productAttribute;
    // }

    
}
