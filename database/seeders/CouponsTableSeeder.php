<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couponRecords = [
            ['id'=>1, 'coupon_option'=>'Manual', 'coupon_code'=>'test10', 'categories'=>'1,2,3,4,5,9,12,13,14', 'brands'=>'1,2,3,4,8', 'users'=>'', 'coupon_type'=>'Single', 'amount_type'=>'Percentage', 'amount'=>'10', 'expiry_date'=>'2024-12-31', 'status'=>1],
            ['id'=>2, 'coupon_option'=>'Manual', 'coupon_code'=>'test20', 'categories'=>'1,2,3,4,5,9,12,13,14', 'brands'=>'1,2,3,4,8', 'users'=>'zauwotennuzi-8539@yopmail.com', 'coupon_type'=>'Single', 'amount_type'=>'Percentage', 'amount'=>'10', 'expiry_date'=>'2024-12-31', 'status'=>1],
            ['id'=>3, 'coupon_option'=>'Automatic', 'coupon_code'=>'iu765ds', 'categories'=>'1,2,3,4,5,9,12,13,14', 'brands'=>'1,2,3,4,8', 'users'=>'zauwotennuzi-8539@yopmail.com', 'coupon_type'=>'Multiple', 'amount_type'=>'Fixed', 'amount'=>'100', 'expiry_date'=>'2024-12-31', 'status'=>1],
        ];
        Coupon::insert($couponRecords);
    }
}
