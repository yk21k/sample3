<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveryAddressRecords = [
            ['id'=>1, 'user_id'=>1, 'name'=>'Clive Giddens', 'address'=>'Osushi 321', 'city'=>'New Tempura', 'state'=>'Tempura', 'country'=>'Japan', 'pincode'=>'11111', 'mobile'=>'123409876', 'status'=>1],
            ['id'=>2, 'user_id'=>2, 'name'=>'Ulysses Hartshorne', 'address'=>'Osushi 456', 'city'=>'New Ramen', 'state'=>'Ramen', 'country'=>'Japan', 'pincode'=>'22222', 'mobile'=>'0987612345', 'status'=>1]

        ];
        DeliveryAddress::insert($deliveryAddressRecords);
    }
}
