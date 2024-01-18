<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsFilter;

class ProductController extends Controller
{
    public function listing(Request $request){
        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count();
        if($categoryCount>0){
            // echo "Category exists";

            // Get Category Details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);

            // Get Category and their Sub Category Products
            $categoryProducts = Product::with(['brand', 'images'])->whereIn('category_id', $categoryDetails['catIds'])->where('products.status', 1);
            // dd($categoryProducts);
            // echo "<pre>"; print_r($categoryProducts);die;

            // Update Query for Products Sorting
            if(isset($request['sort'])&&!empty($request['sort'])){
                if($request['sort']=="product_latest"){
                    $categoryProducts->orderBy('id', 'Desc'); 
                }else if($request['sort']=="lowest_price"){
                    $categoryProducts->orderBy('final_price', 'ASC'); 
                }else if($request['sort']=="highest_price"){
                    $categoryProducts->orderBy('final_price', 'DESC');
                }else if($request['sort']=="best_selling"){
                    $categoryProducts->where('is_bestseller', 'Yes');
                }else if($request['sort']=="featured_items"){
                    $categoryProducts->where('is_featured', 'Yes');
                }else if($request['sort']=="discounted_items"){
                    $categoryProducts->where('product_discount', '>', 0);
                }else{
                    $categoryProducts->orderBy('products.id', 'Desc'); 

                }
            }

            // Update Query for Colors Filters
            if(isset($request['color'])&&!empty($request['color'])){
                $colors = explode('~', $request['color']);
                $categoryProducts->whereIn('products.family_color', $colors);
            }   

            // Update Query for Sizes Filters
            if(isset($request['size'])&&!empty($request['size'])){
                $sizes = explode('~', $request['size']);
                $categoryProducts->join('products_attributes', 'products_attributes.product_id','=', 'products.id')->whereIn('products_attributes.size', $sizes)->groupBy('products_attributes.product_id');
            }

            // Update Query for Brands Filters
            if(isset($request['brand'])&&!empty($request['brand'])){
                $brands = explode('~', $request['brand']);
                $categoryProducts->whereIn('products.brand_id', $brands);
            }

            // Update Query for Prices Filters
            if(isset($request['price'])&&!empty($request['price'])){
                $request['price'] = str_replace("~", "-", $request['price']);
                $prices = explode('-', $request['price']);
                $count = count($prices);
                $categoryProducts->whereBetween('products.final_price', [$prices[0], $prices[$count-1]]);
            }

            // Update Query for Dynamic Filters
            $filterTypes = ProductsFilter::filterTypes();
            foreach($filterTypes as $key => $filter){
                if($request->$filter){
                    $explodeFilterVals = explode('~', $request->$filter);
                    $categoryProducts->whereIn($filter, $explodeFilterVals);
                }
            }

            $categoryProducts = $categoryProducts->paginate(9);

            if($request->ajax()){
                return response()->json([
                    'view'=>(String)View::make('front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'))
                ]);
            }else{
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }

        }else{
            abort(404);
        }
    }

    public function detail($id){
        $productDetails = Product::with('category', 'brand', 'attributes', 'images')->find($id)->toArray();
        // dd($productDetails);    
        // Get Category Details
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails'));
    }
}
