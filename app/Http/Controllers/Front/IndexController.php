<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        // Get Home Page Slider Banners
        $homeSliderBanners = Banner::where('type', 'Slider')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();

        // Get Home Page Fix Banners
        $homeFixBanners = Banner::where('type', 'Fix')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();

        // Get New Arrival Products
        $newProducts = Product::with(['brand', 'images'])->where('status', 1)->orderBy('id', 'Desc')->limit(9)->get()->toArray();
        // dd($newProducts);

        // Get Best Seller Products
        $bestSellers = Product::with(['brand', 'images'])->where(['is_bestseller'=>'Yes', 'status'=>1])->inRandomOrder()->limit(4)->get()->toArray();

        // Get Discounted Products
        $discountedProducts = Product::with(['brand', 'images'])->where('product_discount', '>', 0)->where('status', 1)->where('status', 1)->inRandomOrder()->limit(4)->get()->toArray();

        // Get Featured Products
        $featuredProducts = Product::with(['brand', 'images'])->where(['is_featured'=>'Yes', 'status'=>1])->inRandomOrder()->limit(8)->get()->toArray();

        return view('front.index')->with(compact('homeSliderBanners', 'homeFixBanners', 'newProducts', 'bestSellers','discountedProducts', 'featuredProducts'));
    }

    public function dtest(){

        // Get New Arrival Products
        $newProducts = Product::with(['brand', 'images'])->where('status', 1)->orderBy('id', 'Desc')->limit(9)->get()->toArray();
        // dd($newProducts);

        // Get Best Seller Products
        $bestSellers = Product::with(['brand', 'images'])->where(['is_bestseller'=>'Yes', 'status'=>1])->inRandomOrder()->limit(4)->get()->toArray();

        // Get Discounted Products
        $discountedProducts = Product::with(['brand', 'images'])->where('product_discount', '>', 0)->where('status', 1)->where('status', 1)->inRandomOrder()->limit(4)->get()->toArray();

        // Get Featured Products
        $featuredProducts = Product::with(['brand', 'images'])->where(['is_featured'=>'Yes', 'status'=>1])->inRandomOrder()->limit(8)->get()->toArray();

        return view('front.3dtest')->with(compact('newProducts', 'bestSellers','discountedProducts', 'featuredProducts'));
    }

    public function privacypoliPage(){
        return view('front.privacy_policy');
    }
}
