<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;
use Image;



class BrandController extends Controller
{
    public function brands(){
        Session::put('page', 'brands');
        $brands = Brand::get();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'brand_id'=>$data['brand_id']]);
        }
    }

    public function deleteBrand($id){
        //Delete Brand 
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Brand deleted Successfully!!');
    }

    public function addEditBrand(Request $request, $id=null){
        if($id==""){
            // Add Brand
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand Added Successfully!!";

        }else{
            // Update Edit
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $message = "Brand Updated Successfully!!";           
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            if($id==""){
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required|unique:brands',
                ];
            }else{
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required',
                ];
            }

            $customMessages = [
                'brand_name.required' => 'Brand Name is required',
                'url.required' => 'Brand URL is required',
                'url.unique' => 'Unique Brand URL is required', 
            ];

            $this->validate($request, $rules, $customMessages);

            // Update Brand Image
            if($request->hasFile('brand_image')){
                $image_tmp = $request->file('brand_image');
                if($image_tmp->isValid()){
                    // Get Image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $image_path = 'front/images/brands/'.$imageName;
                    // Upload the Brand Image 
                    Image::make($image_tmp)->save($image_path);
                    $brand->brand_image = $imageName;

                }
            }else{
                $brand->brand_image = "";
            }

            // Update Brand Logo
            if($request->hasFile('brand_logo')){
                $image_tmp = $request->file('brand_logo');
                if($image_tmp->isValid()){
                    // Get Image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $image_path = 'front/images/brands/'.$imageName;
                    // Upload the Brand Image 
                    Image::make($image_tmp)->save($image_path);
                    $brand->brand_logo = $imageName;

                }
            }else{
                $brand->brand_logo = "";
            }

            // Remove Brand Discount from all products belongs to specific Brand 
            if(empty($data['brand_discount'])){
                $data['brand_discount'] = 0;
                if($id!=""){
                    $brandProducts = Product::where('brand_id', $id)->get()->toArray();
                    foreach($brandProducts as $key => $product){
                        if($product['discount_type']=="brand"){
                            Product::where('id', $product['id'])->update(['discount_type'=>'', 'final_price'=>$product['product_price']]);
                        }
                    }
                }    
            }

            if(empty($data['description'])){
                $data['description'] = "Coming Soon";
            }

            $brand->brand_name = $data['brand_name'];
            $brand->brand_discount = $data['brand_discount'];
            $brand->description = $data['description'];
            $brand->url = $data['url'];
            $brand->meta_title = $data['meta_title'];
            $brand->meta_description = $data['meta_description'];
            $brand->meta_keywords = $data['meta_keywords'];
            $brand->status = 1;
            $brand->save();
            return redirect('admin/brands')->with('success_message', $message);

        }
        return view('admin.brands.add_edit_brand')->with(compact('title', 'brand'));
    }
}
