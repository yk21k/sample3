<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsRecords = [
            ['id'=>1, 'category_id'=>14, 'brand_id'=>0, 'product_name'=>'Blue T-Shirts', 'product_code'=>'BT001', 'product_color'=>'Dark Blue', 'family_color'=>'Blue', 'group_code'=>'TSHIRT0000', 'product_price'=>1500, 'product_discount'=>10, 'discount_type'=>'product', 'final_price'=>1350, 'product_weight'=>500, 'product_video'=>'', 'description'=>'Test Product', 'wash_care'=>'', 'keywords'=>'', 'fabric'=>'', 'pattern'=>'', 'sleeve'=>'', 'fit'=>'', 'occassion'=>'', 'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'Yes', 'status'=>1 ],
            ['id'=>2, 'category_id'=>14, 'brand_id'=>0, 'product_name'=>'Red T-Shirts', 'product_code'=>'R001', 'product_color'=>'Red', 'family_color'=>'Red', 'group_code'=>'TSHIRT0000', 'product_price'=>1000, 'product_discount'=>0, 'discount_type'=>'', 'final_price'=>1000, 'product_weight'=>400, 'product_video'=>'', 'description'=>'Test Product', 'wash_care'=>'', 'keywords'=>'', 'fabric'=>'', 'pattern'=>'', 'sleeve'=>'', 'fit'=>'', 'occassion'=>'', 'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'No', 'status'=>1 ],
        ];
        Product::insert($productsRecords);
    }
}
