<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bannerRecords = [
            ['id'=>1, 'type'=>'Slider', 'image'=>'banner1.jpg', 'link'=>'', 'title'=>'Image Creativity', 'alt'=>'Image Creativity', 'sort'=>1, 'status'=>1],
            ['id'=>2, 'type'=>'Slider', 'image'=>'banner4.jpg', 'link'=>'', 'title'=>'Woman Image Creativity', 'alt'=>'Image Creativity', 'sort'=>2, 'status'=>1],
            ['id'=>3, 'type'=>'Slider', 'image'=>'banner9.jpg', 'link'=>'', 'title'=>'Transgender Image Creativity', 'alt'=>'Image Creativity', 'sort'=>3, 'status'=>1],
        ];
        Banner::insert($bannerRecords);
    }
}
