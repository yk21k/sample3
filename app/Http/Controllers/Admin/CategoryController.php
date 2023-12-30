<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Image;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page', 'categories');
        $categories = Category::with('parentcategory')->get();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function deleteCategory($id){
        //Delete Category 
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Category deleted Successfully!!');
    }

    public function addEditCategory(Request $request, $id=null){
        $getCategories = Category::getCategories();
        if($id==""){
            // Add Category
            $title = "Add Category";
            $category = new Category;
            $message = "Category Added Successfully!!";

        }else{
            // Update Edit
            $title = "Edit Category";
           
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            $rules = [ 
                'category_name' => 'required',
                'url' => 'required|unique:categories', 
            ];

            $customMessages = [
                'category_name.required' => 'Category Name is required',
                'url.required' => 'Category URL is required',
                'url.unique' => 'Unique Category URL is required', 
            ];

            $this->validate($request, $rules, $customMessages);

            // Update Category Image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // Get Image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $image_path = 'front/images/categories/'.$imageName;
                    // Upload the Category Image 
                    Image::make($image_tmp)->save($image_path);
                    $category->category_image = $imageName;

                }
            }else{
                $category->category_image = "";
            }

            if(empty($data['category_discount'])){
                $data['category_discount'] = 0;    
            }

            if(empty($data['description'])){
                $data['description'] = "Coming Soon";
            }

            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message', $message);

        }
        return view('admin.categories.add_edit_category')->with(compact('title','category', 'getCategories'));
    }

}
