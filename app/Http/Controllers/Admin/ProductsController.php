<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\Category;
use DB;
use Image;

class ProductsController extends Controller
{
    public function products(){
        $products = Product::with('category')->get()->toArray();
        // dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id){
        //Delete Product 
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Product deleted Successfully!!');
    }

    public function addEditProduct(Request $request, $id=null){
        if($id==""){
            // Add Product
            $title = "Add Product";
            $product = new Product;
            $message = 'Product added Successfully!!';
        }else{
            // Edit Product
            $title = "Edit Produt";
            $product = Product::find($id);
            // dd($product);
            $message = 'Product Updated Successfully!!';
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            // Product Validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
                'product_code' => 'required|regex:/^[\w-]*$/u|max:30',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
                'family_color' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
            ];

            $customMessages = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product Name is required',
                'product_name.regex' => 'Valid Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Valid Product Code is required',
                'product_price.required' => 'Product Price is required',
                'product_price.numeric' => 'Valid Product Price is required',
                'product_color.required' => 'Product Color is required',
                'product_color.regex' => 'Valid Product Color is required',
                'family_color.required' => 'Product Family Color is required',
                'family_color.regex' => 'Valid Product Family Color is required',

            ];

            $this->validate($request, $rules, $customMessages);

            // Update Product Video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    // Upload Video

                    $videoExtension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand().'.'.$videoExtension;
                    $videoPath = "front/videos/products/";
                    $video_tmp->move($videoPath, $videoName);
                    // Save Video name in products table
                    $product->product_video = $videoName; 
                }
            }

            if(!isset($data['product_discount'])){
                $data['product_discount'] = 0;
            }

            if(!isset($data['product_weight'])){
                $data['product_weight'] = 0;
            }
            
            if(!isset($data['description'])){
                $data['description'] = "Coming Soon";
            }

            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->family_color = $data['family_color'];
            $product->group_code = $data['group_code'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];

            if(!empty($data['product_discount'])&&$data['product_discount']>0){
                $product->discount_type = 'product';
                $product->final_price = $data['product_price'] - ($data['product_price'] * $data['product_discount'])/100;
            }else{
                $getCategoryDiscount = Category::select('category_discount')->where('id', $data['category_id'])->first();
                if($getCategoryDiscount->category_discount == 0){
                    $product->discount_type = "";
                    $product->final_price = $data['product_price'];
                }else{
                    $product->discount_type = 'category';
                    $product->final_price = $data['product_price'] - ($data['product_price'] * $getCategoryDiscount->category_discount)/100;
                }
            }

            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->search_keywords = $data['search_keywords'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            $product->status =1;
            $product->save();

            if($id==""){
                $product_id = DB::getPdo()->lastInsertId();
            }else{
                $product_id = $id;
            }

            // Upload Product Images
            if($request->hasFile('product_images')){
                $images = $request->file('product_images');
                // echo "<pre>"; print_r($images); die;

                foreach($images as $key => $image){

                    //Generate Temp Image
                    $image_temp = Image::make($image);

                    //Get Image Extension 
                    $extension = $image->getClientOriginalExtension();

                    //Generate New Image Name
                    $imageName = 'product-'.rand(1111,9999999).'.'.$extension;

                    // Image Path for Small Medium and Large Images
                    $largeImagePath = 'front/images/products/large/'.$imageName; 
                    $mediumImagePath = 'front/images/products/medium/'.$imageName; 
                    $smallImagePath = 'front/images/products/small/'.$imageName;

                    // Upload the Large, Medium and Small Images after Resize
                    Image::make($image_temp)->resize(1040,1200)->save($largeImagePath);
                    Image::make($image_temp)->resize(520,600)->save($mediumImagePath);
                    Image::make($image_temp)->resize(260,300)->save($smallImagePath);

                    // Insert Image Name in products_images table
                    $image = new ProductsImage;
                    $image->image = $imageName;
                    $image->product_id = $product_id;
                    $image->status = 1;
                    $image->save();
                }
            }
            return redirect('admin/products')->with('success_message', $message);
        
        }

        // Get Categories and their Sub Categories
        $getCategories = Category::getCategories();

        // Product Filters
        $productsFilters = Product::productsFilters();

        return view('admin.products.add_edit_product')->with(compact('title', 'getCategories', 'productsFilters', 'product'));
    }

    public function deleteProductsImage($id){
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get Product Video Path
        $product_path = "front/videos/products/";

        // Delete Product Video from Folder if exists
        if(file_exists($product_path.$productVideo->product_video)){
            unlink($product_path.$productVideo->product_video);
        }
        // Delete Product Video from table
        Product::where('id', $id)->update(['product_video'=>'']);

        $message = "Product Video has been Deleted Successfully!!";
        return redirect()->back()->with('success_message', $message);
    }
}
